<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaFormRequest;
use App\Http\Requests\VendaUpdateFormRequest;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function store(VendaFormRequest $request)
    {

        //criar a venda
        $venda = Venda::create([
            'cliente_id' => $request->cliente_id,
            'data_venda' => date('Y-m-d H:i:s'),
            'desconto' => $request->desconto,
            'subtotal' => 0,
            'total' => 0
        ]);

        $subtotal = 0;
        foreach ($request->itens as $item) {
            $subtotal += $item["quantidade"] * $item["preco_unitario"];

            $itemVenda = ItemVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $item["produto_id"],
                'quantidade' => $item["quantidade"],
                'preco_unitario' => $item["preco_unitario"],
                'subtotal_item' => $subtotal
            ]);
            
            $produto = Produto::find($itemVenda->produto_id);
            $produto->quantidade_estoque = $item["quantidade"];

            $produto->update();
        }



        $venda->update([
            'subtotal' => $subtotal,
            'total' => $subtotal - $request->desconto
        ]);

        return response()->json([
            'status' => true,
            'message' => 'cadastrado com sucesso',
            'data' => $venda
        ]);


    }

    public function index()
    {
        $vendas = Venda::all();

        return response()->json([
            'status' => 'true',
            'data' => $vendas
        ]);
    }

    public function show($id)
    {
        $venda = Venda::find($id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'Venda nao encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $venda
        ]);
    }

    public function update(VendaUpdateFormRequest $request, $id)
    {

        

        $venda = Venda::find($id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'Venda nao encontrado'
            ]);
        }

        // "cliente_id": 1,
		// "data_venda": "2025-02-06 13:18:30",
		// "desconto": 10,
		// "subtotal": 5000,
		// "total": 4990,

        if (isset($request->cliente_id)) {
            $venda->cliente_id = $request->cliente_id;
        }

        if (isset($request->data_venda)) {
            $venda->data_venda = $request->data_venda;
            
        }

        if (isset($request->desconto)) {
            $venda->desconto = $request->desconto;
        }

        

        $venda->update();

        return response()->json([
            'status' => true,
            'message' => 'atualizado com sucesso',
            'data' => $venda
        ]);
    }

    public function destroy(Request $request)
    {
        $venda = Venda::find($request->id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'Venda nao encontrado'
            ]);
        }

        $venda->delete();

        return response()->json([
            'status' => true,
            'message' => 'venda excluido com sucesso'
        ]);
    }
}
