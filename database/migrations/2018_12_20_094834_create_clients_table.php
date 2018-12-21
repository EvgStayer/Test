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
            $table->date('next_payment')->default(date('Y-m-d'));
            $table->date('last_payment')->default(date('Y-m-d'));
            $table->date('create_date')->default(date('Y-m-d'));
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
