<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\HabitacionFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $habitaciones = DB::table('habitacion as h')
            ->select('h.id', 'h.tipo', 'h.numero', 'h.precio', 'h.fotografia')
            ->where(function ($query) use ($texto) {
                $query->where('h.tipo', 'LIKE', '%' . $texto . '%')
                    ->orWhere('h.numero', 'LIKE', '%' . $texto . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(7);

        return view('reservas.habitacion.index', compact('habitaciones', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view("reservas.habitacion.create", compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $habitacion = new Habitacion();
        $habitacion->tipo = $request->tipo;
        $habitacion->numero = $request->numero;
        $habitacion->precio = $request->precio;

        if ($request->hasFile("fotografia")) {
            $fotografia = $request->file("fotografia");
            $nombreFotografia = Str::slug($request->numero) . "." . $fotografia->guessExtension();
            $ruta = public_path("/imagenes/habitaciones/");
            copy($fotografia->getRealPath(), $ruta . $nombreFotografia);
            $habitacion->fotografia = $nombreFotografia;
        }

        $habitacion->save();

        return Redirect::to('reservas/habitacion');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('reservas.habitacion.edit', compact('habitacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $habitacion = Habitacion::findOrFail($id);

        $habitacion->tipo = $request->tipo;
        $habitacion->numero = $request->numero;
        $habitacion->precio = $request->precio;

        if ($request->hasFile("fotografia")) {
            $fotografia = $request->file("fotografia");
            $nombreFotografia = Str::slug($request->numero) . "." . $fotografia->guessExtension();
            $ruta = public_path("/imagenes/habitaciones/");
            copy($fotografia->getRealPath(), $ruta . $nombreFotografia);
            $habitacion->fotografia = $nombreFotografia;
        }

        $habitacion->save();

        return Redirect::to('reservas/habitacion');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();
        return redirect()->route('habitacion.index')->with('success', 'Habitación eliminada correctamente');
    }
}
