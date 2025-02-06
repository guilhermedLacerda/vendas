<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteUpdateFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function store (ClienteFormRequest $request) {
        $cliente = Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco
        ]);

        return response()->json([
            'status' => true,
            'message' => 'cadastrado com sucesso',
            'data' => $cliente
        ]);
    }

    public function index () {
        $clientes = Cliente::all();

        return response()->json([
            'status' => 'true',
            'data' => $clientes
        ]);
    }

    public function show ($id) {
        $cliente = Cliente::find($id);

        if($cliente == null) {
            return response()->json([
                'status' => false,
                'message' => 'Cliente nao encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $cliente
        ]);
    }

    public function update(ClienteUpdateFormRequest $request, $id) {
        $cliente = Cliente::find($id);

        if($cliente == null) {
            return response()->json([
                'status' => false,
                'message' => 'Cliente nao encontrado'
            ]);
        }
        
        
        if(isset($request->nome)) {
            $cliente->nome = $request->nome;
        }
        
        if(isset($request->email)) {
            $cliente->email = $request->email;
        }
        
        if(isset($request->telefone)) {
            $cliente->telefone = $request->telefone;
        }
        
        if(isset($request->endereco)) {
            $cliente->endereco = $request->endereco;
        }
        
        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => 'atualizado com sucesso',
            'data' => $cliente 
        ]);
    }

    public function destroy (Request $request) {
        $cliente = Cliente::find($request->id);

        if($cliente == null) {
            return response()->json([
                'status' => false,
                'message' => 'Cliente nao encontrado'
            ]);
        }

        $cliente->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cliente excluido com sucesso'
        ]);

    }
}
