<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 250)->unique();
            $table->bigInteger("price");
            $table->string("image", 250);
            $table->text("desc");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("outlet_id");
            $table->foreign("user_id")->references('id')->on('users')
            ->onUpdate("cascade");
            $table->foreign("outlet_id")->references("id")->on("outlets")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories")
                ->onDelete(null)
                ->onUpdate("cascade");
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('products');
    }
}
