<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('cliente_id')->unsigned()->nullable(false);
            $table->timestamp('data_venda')->nullable(false);
            $table->decimal('subtotal', 15,2)->nullable(false)->default(0);
            $table->decimal('desconto', 15,2)->nullable(true)->default(0);
            $table->decimal('total', 15,2)->nullable(false)->default(0);
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
