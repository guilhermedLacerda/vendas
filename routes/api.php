<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Cliente
Route::post('/clientes', [ClienteController::class, 'store']);
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/find/{id}', [ClienteController::class, 'show']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes', [ClienteController::class, 'destroy']);

// Produto
Route::post('/produtos', [ProdutoController::class, 'store']);
Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/find/{id}', [ProdutoController::class, 'show']);
Route::put('/produtos/{id}', [ProdutoController::class, 'update']);
Route::delete('/produtos', [ProdutoController::class, 'destroy']);

// Venda
Route::post('/vendas', [VendaController::class, 'store']);
Route::get('/vendas', [VendaController::class, 'index']);
Route::get('/vendas/find/{id}', [VendaController::class, 'show']);
Route::put('/vendas/{id}', [VendaController::class, 'update']);
Route::delete('/vendas', [VendaController::class, 'destroy']);

// Itens_venda
Route::post('/itens-venda', [ItemVendaController::class, 'store']);
Route::get('/itens-venda', [ItemVendaController::class, 'index']);
Route::get('/itens-venda/find/{id}', [ItemVendaController::class, 'show']);
Route::put('/itens-venda/{id}', [ItemVendaController::class, 'update']);
Route::delete('/itens-venda', [ItemVendaController::class, 'destroy']);
