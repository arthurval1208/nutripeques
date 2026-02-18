<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    public function testFirestore()
    {
    $firestore = app('firebase.firestore')->database();

    $documents = $firestore->collection('servicios')->documents();

    $data = [];

    foreach ($documents as $doc) {
        if ($doc->exists()) {
            $item = $doc->data();
            $item['id'] = $doc->id();
            $data[] = $item;
        }
    }

    return response()->json($data);
}


    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);

        Servicio::create($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio creado');
    }

    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);

        $servicio->update($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado');
    }
}
