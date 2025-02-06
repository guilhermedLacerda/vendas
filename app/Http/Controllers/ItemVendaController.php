<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemVendaFormRequest;
use App\Http\Requests\ItemVendaUpdateFormRequest;
use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function index () {
        $itemVendas = ItemVenda::all();

        return response()->json([
            'status' => 'true',
            'data' => $itemVendas
        ]);
    }

    public function show ($id) {
        $itemVenda = ItemVenda::find($id);

        if($itemVenda == null) {
            return response()->json([
                'status' => false,
                'message' => 'itemVenda nao encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $itemVenda
        ]);
    }

    public function update(ItemVendaUpdateFormRequest $request, $id) {
        $itemVenda = ItemVenda::find($id);

        if($itemVenda == null) {
            return response()->json([
                'status' => false,
                'message' => 'ItemVenda nao encontrado'
            ]);
        }
        
        
        if(isset($request->venda_id)) {
            $itemVenda->venda_id = $request->venda_id;
        }
        
        if(isset($request->produto_id)) {
            $itemVenda->produto_id = $request->produto_id;
        }
        
        if(isset($request->quantidade)) {
            $itemVenda->quantidade = $request->quantidade;
        }   

        if(isset($request->preco_unitario)) {
            $itemVenda->preco_unitario = $request->preco_unitario;
        }  
        
       

        $itemVenda->update([
            'subtotal_item' => $request->preco_unitario * $request->quantidade
        ]);

        return response()->json([
            'status' => true,
            'message' => 'atualizado com sucesso',
            'data' => $itemVenda 
        ]);
    }

    public function destroy (Request $request) {
        $itemVenda = ItemVenda::find($request->id);

        if($itemVenda == null) {
            return response()->json([
                'status' => false,
                'message' => 'itemVenda nao encontrado'
            ]);
        }

        $itemVenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'itemVenda excluido com sucesso'
        ]);

    }
}
