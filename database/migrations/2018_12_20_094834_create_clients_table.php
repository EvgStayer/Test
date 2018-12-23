<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio');
            $table->string('email')->unique();
            $table->integer('balance')->default(0);
            $table->boolean('status')->default(false); 
            $table->datetime('next_payment')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('last_payment')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
