<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Categorias;
use App\Http\Requests\UpdatedCategoriaRequest;

class CategoriasController extends Controller
{
     public function index(Request $request){

        //$categorias = Categorias::get(); // trae todas excepto las eliminadas
       $categorias = Categorias::withTrashed()->get(); //trae todas
        //$categorias = Categorias::onlyTrashed()->get();// trae solo las eliminadas

        return view('categorias.index', ["categorias"=>$categorias]);
    }

    public function create(){
        return view('categorias.new');
    }


    public function store(Request $request){
        $request->validate([
            'descripcion' => 'required',
            'nombre' => 'required|unique:categorias,nombre',
        ],
        [
            'descripcion.required' => 'el campo descripcion debe ser requerido',
            'nombre.required'      => 'el campo nombre es requerido',
            'nombre.unique'        => 'ya existe una categoria con ese nombre'
        ]
        );
        $categorias = new Categorias();
        $categorias->fill([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            ]);
        $categorias->save();
        $request->session()->flash('mensaje-success', 'La categoría fue cargada.');
        return redirect('/categorias');
    }

 
    public function show($id){
        $categorias = Categorias::findOrfail($id);

        return view('categorias.show', ["cat"=>$categorias]);
    }


    public function edit($id){
        $categorias = Categorias::findOrfail($id);
        return view('categorias.edit', ["cat"=>$categorias]);
    }

    public function update(UpdatedCategoriaRequest $request, $id){
    
        $categorias = Categorias::findOrfail($id);
        $categorias->fill([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
        ]);
        $categorias->update();
          $request->session()->flash('mensaje-success', 'La categoría fue actualizada.');
          return redirect('/categorias');
    }

public function destroy(Request $request, $id){
        $categorias = Categorias::findOrfail($id);
        $categorias->delete();
        $request->session()->flash('mensaje-success', 'La categoría fue eliminada.');
        return redirect('/categorias');
    }

    public function restaurar(Request $request, $id){
        $categoria = Categorias::withTrashed()->findOrfail($id);
        $categoria->restore();
        $request->session()->flash('mensaje-success', 'La categoría fue eliminada.');
        return redirect('/categorias');
    }
}
