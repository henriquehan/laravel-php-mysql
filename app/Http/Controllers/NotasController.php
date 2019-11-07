<?php

namespace App\Http\Controllers;
use app\Aluno;
use app\Nota;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function index(Request $request, $id)
    {
        $aluno = Aluno::with('notas')->find($id);
        return $aluno;
    }

    public function store(Request $request)
    {
        if(!$aluno = aluno::find($id))
            return response()->json(['error' => 'Aluno informado não encontrado'], 404);

        return $aluno->notas()->create($request->all());
    }

    public function show($id)
    {
        $aluno = Aluno::with(['notas', function ($query) use ($nota_id){
            $query->find('id', $nota_id);
        }])->find($aluno_id);

        return $aluno;
    }


    public function destroy($id)
    {
        //
    }
}
