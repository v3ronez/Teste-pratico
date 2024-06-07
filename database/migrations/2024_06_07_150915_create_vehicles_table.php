<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments("id");
            $table->string("plate", 7)->unique();
            $table->string("renavam")->unique();
            $table->string("model");
            $table->string("brand");
            $table->string("year", 4);
            $table->integer("owner_id");

            $table
                ->foreign("owner_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
