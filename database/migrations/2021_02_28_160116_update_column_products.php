<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->string('image');
            $table->integer('user_id');
            $table->integer('cat_id');
            $table->string('p_code');
            $table->string('color');
            $table->unsignedBigInteger('satuan_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('image');
            $table->dropColumn('user_id');
            $table->dropColumn('cat_id');
            $table->dropColumn('p_code');
            $table->dropColumn('color');
            $table->dropColumn('satuan_id');
        });
    }
}
