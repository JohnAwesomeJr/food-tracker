<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFoodDatapointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_datapoints', function (Blueprint $table) {
            $table->id();
            $table->string('image_file_name');
            $table->integer('rating');
            $table->unsignedBigInteger('food_tracker_id');
            $table->foreign('food_tracker_id')
                ->references('id')
                ->on('food_trackers')
                ->onDelete('cascade');
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
        Schema::dropIfExists('food_datapoints');
    }
}
