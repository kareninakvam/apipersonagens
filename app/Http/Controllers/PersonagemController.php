<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personagem;

class PersonagemController extends Controller
{

    public function index()
    {
        $personagens = Personagem::all();
        return response()->json($personagens);

    }


    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nome' => 'required',
        'idade' => 'required|numeric',
        'resumo_profissional' => 'required',
        'experiencia' => 'required',
        'educacao' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $personagem = new Personagem();
    $personagem->nome = $request->input('nome');
    $personagem->idade = $request->input('idade');
    $personagem->resumo_profissional = $request->input('resumo_profissional');
    $personagem->experiencia = $request->input('experiencia');
    $personagem->educacao = $request->input('educacao');

    $personagem->save();

    return response()->json($personagem, 201);
}


    public function show($id)
{
    $personagem = Personagem::find($id);

    if (!$personagem) {
        return response()->json(['message' => 'Personagem não encontrado'], 404);
    }

    return response()->json($personagem);
}


    public function edit($id)
    {
        $personagem = Personagem::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $personagem
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $personagem = Personagem::find($id);

        if (!$personagem) {
            return response()->json(['message' => 'Personagem não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'idade' => 'required|numeric',
            'resumo_profissional' => 'required',
            'experiencia' => 'required',
            'educacao' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $personagem->nome = $request->input('nome');
        $personagem->idade = $request->input('idade');
        $personagem->resumo_profissional = $request->input('resumo_profissional');
        $personagem->experiencia = $request->input('experiencia');
        $personagem->educacao = $request->input('educacao');
        $personagem->save();

        return response()->json($personagem);
    }


    public function destroy($id)
    {
        $personagem = Personagem::find($id);

        if (!$personagem) {
            return response()->json(['message' => 'Personagem não encontrado'], 404);
        }

        $personagem->delete();

        return response()->json(['message' => 'Personagem excluído com sucesso']);
    }
}
