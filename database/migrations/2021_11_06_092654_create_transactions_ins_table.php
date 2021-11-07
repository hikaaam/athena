<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_in', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("supplier_id");
            $table->bigInteger("price");
            $table->string("name", 250)->unique();
            $table->integer("qty");
            $table->enum("unit", ["Kg", "Gr", "Buah"])->default("Buah");
            $table->unsignedBigInteger("user_id");
            $table->foreign("supplier_id")->references("id")->on("suppliers")->onUpdate("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_in');
    }
}
