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
        Schema::table('facturas', function(Blueprint $table)
        {
            $table->unique('codigo');
        });

        Schema::table('suministros', function(Blueprint $table)
        {
            $table->unique('codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facturas', function(Blueprint $table)
        {
            $table->dropUnique('codigo');
        });

        Schema::table('suministros', function(Blueprint $table)
        {
            $table->dropUnique('codigo');
        });
    }
};
