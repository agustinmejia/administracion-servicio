<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;

// Models
use App\Models\User;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Servicio;
use App\Models\ServiciosDetalle;
use App\Models\ServiciosEstado;
use App\Models\ServiciosEstadosDetalle;
use App\Models\TipoEquipo;

class ServiciosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = ServiciosEstado::where('deleted_at', NULL)->orderBy('orden', 'ASC')->get();
        $empleados = Empleado::with('cargo')->where('deleted_at', NULL)->get();
        return view('servicios.browse', compact('estados', 'empleados'));
    }

    public function list($estado = null)
    {
        switch ($estado) {
            case 'pedientes':
                $query = "entregado = 0";
                break;
            case 'entregados':
                    $query = "entregado = 1";
                    break;
            default:
                $query = 1;
                break;
        }
        $data = Servicio::with(['detalle.tipo', 'estados_servicio.estado', 'cliente', 'empleado.cargo', 'detalle' => function($q){
            $q->where('deleted_at', NULL);
        }])->where('deleted_at', NULL)->whereRaw($query)->get();
        // return $data;

        return
            Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cliente', function($row){
                $cliente = '
                    <div class="col-md-12">
                        <b>'.$row->cliente->nombre_completo.'</b><br>
                        <small>Cel: '.($row->cliente->celular ?? 'No definido').'</small>
                    </div>';
                return $cliente;
            })
            ->addColumn('detalles', function($row){
                $detalles = '';
                foreach ($row->detalle as $item) {
                    $detalles .= '<li><b>'.$item->tipo->nombre.'</b> '.$item->equipo.' - '.$item->problema.'</li>';
                }
                return '
                    <div class="col-md-12">
                        <ul>'.$detalles.'</ul>
                    </div>';
            })
            ->addColumn('estado', function($row){
                $count = count($row->estados_servicio);
                $estado = $count > 0 ? $row->estados_servicio[$count -1]->estado->nombre : 'No definido';

                return '
                        <div class="col-md-12">
                            <label class="label label-default">'.$estado.'</label>
                        </div>';
            })
            ->addColumn('action', function($row){
                $btn_mas = "<li><a href='#' data-toggle='modal' data-target='#etapa_modal' onclick='changeStatus(".(json_encode($row)).")'>Etapa</a></li>";
                $actions = '
                    <div class="no-sort no-click bread-actions text-right">
                        <div class="btn-group" style="margin-right: 5px">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Más <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>'.(!$row->entregado ? $btn_mas : '').'</li>
                                <li><a href="'.route('servicios.proforma.edit', ['id' => $row->id]).'">Proforma</a></li>
                                '.(!$row->entregado ? '<li><a href="#" data-toggle="modal" data-target="#entrega_modal" onclick="EntregaItem('.$row->id.')">Entregar</a></li>' : '').'
                            </ul>
                        </div>
                    
                        <a href="'.route('servicios.show', ['servicio' => $row->id]).'" title="Ver" class="btn btn-sm btn-warning view">
                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                        </a>
                        <a href="'.(!$row->entregado ? route('servicios.edit', ['servicio' => $row->id]) : '#' ).'" title="Editar" class="btn btn-sm btn-primary edit">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        <a title="Borrar" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="'.(!$row->entregado ? '#delete_modal' : '' ).'" onclick="deleteItem('.$row->id.')">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                        </a>
                    </div>
                        ';
                return $actions;
            })
            ->rawColumns(['cliente', 'detalles', 'estado', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'add';
        $clientes = Cliente::where('deleted_at', NULL)->get();
        $empleados = Empleado::with('cargo')->where('deleted_at', NULL)->get();
        $tipo_equipo = TipoEquipo::where('deleted_at', NULL)->get();
        return view('servicios.edit-add', compact('type', 'clientes', 'empleados', 'tipo_equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
        ]);
        if(!isset($request->equipo)){
            return back()->with('error_detalle', 'Debes agregar el o los equipos a los que se les va a realizar el servicio.');
        }

        DB::beginTransaction();
        try {
            $servicio = Servicio::create([
                'user_id' => Auth::user()->id,
                'empleado_id' => $request->empleado_id,
                'cliente_id' => $request->cliente_id,
                'observaciones' => $request->observaciones,
                'fecha_entrega' => $request->fecha_entrega,
                'costo' => $request->costo
            ]);

            for ($i=0; $i < count($request->equipo); $i++) { 
                $servicios_detalle = ServiciosDetalle::create([
                    'servicio_id' => $servicio->id,
                    'tipo_equipo_id' => $request->tipo_equipo_id[$i],
                    'equipo' => $request->equipo[$i],
                    'descripcion' => $request->descripcion[$i],
                    'problema' => $request->problema[$i],
                    'diagnostico' => $request->diagnostico[$i],
                    'solucion' => $request->solucion[$i],
                ]);
            }


            $estados = ServiciosEstado::where('deleted_at', NULL)->orderBy('orden', 'ASC')->limit(2)->get();
            if($request->empleado_id){
                ServiciosEstadosDetalle::create([
                    'servicio_id' => $servicio->id,
                    'empleado_id' => $request->empleado_id,
                    'servicios_estado_id' => count($estados) > 1 ? $estados[1]->id : NULL
                ]);
            }else{
                ServiciosEstadosDetalle::create([
                    'servicio_id' => $servicio->id,
                    'servicios_estado_id' => count($estados) > 0 ? $estados[0]->id : NULL
                ]);
            }

            DB::commit();
            return redirect()->route('servicios.index')->with(['message' => 'Servicio guardado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('servicios.index')->with(['message' => 'Ocurrio un error al guardar el servicio.', 'alert-type' => 'error']);
        }
    }

    public function etapas_tore(Request $request){
        try {

            Servicio::where('id', $request->servicio_id)->update([
                'empleado_id' => $request->empleado_id,
                'costo' => $request->costo
            ]);

            ServiciosEstadosDetalle::create([
                'servicio_id' => $request->servicio_id,
                'empleado_id' => $request->empleado_id,
                'observaciones' => $request->observaciones,
                'servicios_estado_id' => $request->servicios_estado_id
            ]);

            return redirect()->route('servicios.index')->with(['message' => 'Etapa actualizada exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('servicios.index')->with(['message' => 'Ocurrio un error al guardar la etapa.', 'alert-type' => 'error']);
        }
    }

    public function entregado($id, Request $request){
        $empleado = Empleado::where('user_id', Auth::user()->id)->first();
        $estado = ServiciosEstado::where('deleted_at', NULL)->orderBy('orden', 'DESC')->first();

        try {
            Servicio::where('id', $id)->update([
                'entregado' => 1
            ]);

            ServiciosEstadosDetalle::create([
                'servicio_id' => $id,
                'empleado_id' => $empleado ? $empleado->id : null,
                'observaciones' => $request->observaciones,
                'servicios_estado_id' => $estado ? $estado->id : null
            ]);

            return redirect()->route('servicios.index')->with(['message' => 'Servicio entregado y cerrado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('servicios.index')->with(['message' => 'Ocurrio un error al entregar el servicio.', 'alert-type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reg = Servicio::with(['detalle.tipo', 'estados_servicio.estado', 'cliente', 'empleado.cargo', 'detalle' => function($q){
            $q->where('deleted_at', NULL);
        }])->where('id', $id)->first();
        // return $reg;
        return view('servicios.read', compact('id', 'reg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 'edit';
        $reg = Servicio::with(['detalle.tipo', 'estados_servicio.estado', 'cliente', 'detalle' => function($q){
            $q->where('deleted_at', NULL);
        }])->where('id', $id)->first();
        $clientes = Cliente::where('deleted_at', NULL)->get();
        $empleados = Empleado::with('cargo')->where('deleted_at', NULL)->get();
        $tipo_equipo = TipoEquipo::where('deleted_at', NULL)->get();
        return view('servicios.edit-add', compact('type', 'reg', 'clientes', 'empleados', 'tipo_equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required',
        ]);
        if(!isset($request->equipo)){
            return back()->with('error_detalle', 'Debes agregar el o los equipos a los que se les va a realizar el servicio.');
        }

        DB::beginTransaction();
        try {
            $servicio = Servicio::where('id', $id)->update([
                'user_id' => Auth::user()->id,
                'empleado_id' => $request->empleado_id,
                'cliente_id' => $request->cliente_id,
                'observaciones' => $request->observaciones,
                'fecha_entrega' => $request->fecha_entrega,
                'costo' => $request->costo
            ]);

            // Eliminar el anterior detalle de los equipos
            ServiciosDetalle::where('servicio_id', $id)->update(['deleted_at' => Carbon::now()]);
            for ($i=0; $i < count($request->equipo); $i++) { 
                $servicios_detalle = ServiciosDetalle::create([
                    'servicio_id' => $id,
                    'tipo_equipo_id' => $request->tipo_equipo_id[$i],
                    'equipo' => $request->equipo[$i],
                    'descripcion' => $request->descripcion[$i],
                    'problema' => $request->problema[$i],
                    'diagnostico' => $request->diagnostico[$i],
                    'solucion' => $request->solucion[$i],
                ]);
            }

            DB::commit();
            return redirect()->route('servicios.index')->with(['message' => 'Servicio atualizado exitosamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('servicios.index')->with(['message' => 'Ocurrio un error al actualizar el servicio.', 'alert-type' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Servicio::where('id', $id)->update([
            'deleted_at' => Carbon::now()
        ]);
        return redirect()->route('servicios.index')->with(['message' => 'Servicio eliminado exitosamente.', 'alert-type' => 'success']);
    }


    public function proforma_edit($id){
        $reg = Servicio::find($id);
        $cliente = Cliente::find($reg->cliente_id);
        $detalles = DB::table('servicios_detalles as sd')
                        ->join('tipo_equipos as te', 'te.id', 'sd.tipo_equipo_id')
                        ->where('sd.servicio_id', $id)->where('sd.deleted_at', NULL)
                        ->select('sd.*', 'te.nombre')->get();
        return view('servicios.proforma', compact('reg', 'cliente', 'detalles'));
    }

    public function proforma_update($id, Request $request){
        Servicio::where('id', $id)->update([
            'proforma' => $request->proforma
        ]);
        return redirect()->route('servicios.proforma.edit', ['id' => $id])->with(['message' => 'Proforma editada exitosamente.', 'alert-type' => 'success']);
    }

    public function proforma_reset($id){
        Servicio::where('id', $id)->update([
            'proforma' => null
        ]);
        return redirect()->route('servicios.proforma.edit', ['id' => $id])->with(['message' => 'Proforma reseteada exitosamente.', 'alert-type' => 'success']);
    }

    public function proforma_print($id){
        $reg = Servicio::find($id);
        return view('servicios.print.proforma', compact('reg'));
    }
}
