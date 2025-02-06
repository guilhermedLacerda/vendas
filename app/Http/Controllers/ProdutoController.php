<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoFormRequest;
use App\Http\Requests\ProdutoUpdateFormRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store (ProdutoFormRequest $request) {
        $produto = Produto::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'preco' => $request->preco,
            'quantidade_estoque' => $request->quantidade_estoque
        ]);

        return response()->json([
            'status' => true,
            'message' => 'cadastrado com sucesso',
            'data' => $produto
        ]);
    }

    public function index () {
        $produtos = Produto::all();

        return response()->json([
            'status' => 'true',
            'data' => $produtos
        ]);
    }

    public function show ($id) {
        $produto = Produto::find($id);

        if($produto == null) {
            return response()->json([
                'status' => false,
                'message' => 'Produto nao encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $produto
        ]);
    }

    public function update (ProdutoUpdateFormRequest $request, $id) {
        $produto = Produto::find($id);

        if($produto == null) {
            return response()->json([
                'status' => false,
                'message' => 'produto nao encontrado'
            ]);
        }

        if(isset($request->nome)) {
            $produto->nome = $request->nome;
        }

        if(isset($request->codigo)) {
            $produto->codigo = $request->codigo;
        }

        if(isset($request->preco)) {
            $produto->preco = $request->preco;
        }

        if(isset($request->quantidade_estoque)) {
            $produto->quantidade_estoque = $request->quantidade_estoque;
        }

        $produto->update();

        return response()->json([
            'status' => true,
            'message' => 'atualizado com sucesso',
            'data' => $produto
        ]);
    }

    public function destroy (Request $request) {
        $produto = Produto::find($request->id);

        if($produto == null) {
            return response()->json([
                'status' => false,
                'message' => 'Cliente nao encontrado'
            ]);
        }

        $produto->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cliente excluido com sucesso'
        ]);

    }
}
