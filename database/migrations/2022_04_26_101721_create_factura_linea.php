<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_linea', function (Blueprint $table) {
            $table->foreignId('factura_id')->constrained('facturas');
            $table->foreignId('suministro_id')->constrained('suministros');
            $table->primary(['factura_id', 'suministro_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_linea');
    }
};
