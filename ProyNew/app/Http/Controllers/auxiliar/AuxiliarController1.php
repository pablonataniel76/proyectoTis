<?php

namespace App\Http\Controllers\Auxiliar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Estudiantes;
use App\Portafolio;
//use proyecto\Estudiante;
use App\Auxiliar;
use App\Http\Requests\AuxiliarFormRequest;
use DB;


class AuxiliarController1 extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $estudiantes=DB::table('estudiante')->where('NOMBRE_ESTUDIANTE','LIKE','%'.$query.'%')
            // ->where ('grupo','=','1')
            ->orderBy('ID_ESTUDIANTE')
            ->paginate(10);
            return view('auxiliar.index',["estudiantes"=>$estudiantes,"searchText"=>$query]);
        }
    }
    public function create()
    {

    }
    public function store (AuxiliarFormRequest $request)
    {
        // $aux = new estudiante();
        // $aux->tipo_asignatura = $request->input('comentario');
        // $aux->save();
        // return redirect()->route('auxiliar.index');
        //
        $est=new Portafolio;
        $est->COMENTARIO_AUXILIAR=$request->get('comentario');
        $est->condicion='1';
        $est->save();
        return Redirect::to('almacen/categoria');
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
      return view("auxiliar.edit",["estudiante"=>Estudiantes::findOrFail($id)]);
    }
    public function update(AuxiliarFormRequest $request,$id)
    {
        // $est = Estudiantes::find($id);
        // $est->NOMBRE_ESTUDIANTE = $request->input('NOMBRE_ESTUDIANTE');
        // $aux->save();
        // return redirect()->route('auxiliar.index');
        //
        $estudiante=Estudiantes::findOrFail($id);
        $aux=Portafolio::findOrFail($estudiante);
        $aux->COMENTARIO_AUXILIAR=$request->get('comentario');
        $aux->update();
        return Redirect::to('auxiliar');
    }
    public function destroy($id)
    {

    }
}
