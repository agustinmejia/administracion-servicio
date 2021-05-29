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
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentasDetalle;
use App\Models\RegistrosCaja;

class VentasController extends Controller
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
        return view('ventas.browse');
    }

    public function list()
    {
        $data = Venta::with(['empleado', 'cliente', 'detalle.producto'])->where('deleted_at', NULL)->get();
        // return $data;

        return
            Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cliente', function($row){
                if($row->proforma){
                    return $row->cliente->nombre_completo.'<br><label class="label label-danger">Proforma</label>';
                }else{
                    return $row->cliente->nombre_completo;
                }
            })
            ->addColumn('detalle', function($row){
                $detalle = '';
                foreach ($row->detalle as $item) {
                    $detalle .= "<li>".$item->producto->nombre."</li>";
                }
                return "<ul>".$detalle."</ul>";
            })
            ->addColumn('total', function($row){
                $total = 0;
                foreach ($row->detalle as $item) {
                    $total += $item->cantidad * $item->costo;
                }
                return number_format($total, 2, ',', '.').' Bs.';
            })
            ->addColumn('fecha', function($row){
                return date('d-M-Y', strtotime($row->created_at)).'<br> <small>'.Carbon::parse($row->created_at)->diffForHumans().'</small>';
            })
            ->addColumn('action', function($row){
                $url = "'".route('ventas.destroy', ['venta' => $row->id])."'";
                $actions = '
                            <div class="no-sort no-click bread-actions text-right">
                                <a href="'.route('ventas.show', ['venta' => $row->id]).'" title="Ver" class="btn btn-sm btn-warning view">
                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                </a>
                                <a title="Borrar" class="btn btn-sm btn-danger delete" data-toggle="modal" data-target="#delete_modal" onclick="deleteItem('.$row->id.')">
                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                                </a>
                            </div>
                        ';
                return $actions;
        })
        ->rawColumns(['cliente', 'detalle', 'total', 'fecha', 'action'])
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
        $productos = Producto::all()->where('deleted_at', NULL);
        return view('ventas.edit-add', compact('type', 'clientes', 'empleados', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $venta = Venta::create([
                'user_id' => Auth::user()->id,
                'cliente_id' => $request->cliente_id,
                'observaciones' => $request->observaciones,
                'proforma' => $request->proforma ?? 0
            ]);

            $total = 0;
            for ($i=0; $i < count($request->producto_id); $i++) { 
                VentasDetalle::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $request->producto_id[$i],
                    'cantidad' => $request->cantidad[$i],
                    'costo' => $request->precio[$i],
                    'detalle' => $request->detalle[$i]
                ]);
                $total += $request->precio[$i] * $request->cantidad[$i];
            }

            RegistrosCaja::create([
                'user_id' => Auth::user()->id,
                'detalle' => 'Venta Realizada',
                'tipo' => 'ingreso',
                'monto' => $total,
                'venta_id' => $venta->id
            ]);

            DB::commit();
            return redirect()->route('ventas.index')->with(['message' => 'Venta guardada exitosamente.', 'alert-type' => 'success', 'print' => $request->proforma ? $venta->id : 0]);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('ventas.index')->with(['message' => 'Ocurrio un error al guardar la venta.', 'alert-type' => 'error']);
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
        $reg = Venta::with(['cliente', 'detalle.producto'])->where('id', $id)->first();
        return view('ventas.read', compact('id', 'reg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Venta::where('id', $id)->update([
            'deleted_at' => Carbon::now()
        ]);
        return redirect()->route('ventas.index')->with(['message' => 'Venta eliminado exitosamente.', 'alert-type' => 'success']);
    }

    // PDF
    public function proforma_generate($id){
        $reg = Venta::with(['cliente', 'detalle.producto'])->where('id', $id)->where('proforma', 1)->first();
        return view('ventas.pdf.proforma', compact('reg'));
    }
}
