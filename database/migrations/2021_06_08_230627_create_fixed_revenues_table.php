<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_revenues', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 100)->nullable(false);
            $table->string('description', 255)->nullable(false);
            $table->double('value')->nullable(false);

            $table->integer('activation_control_id')->unsigned();
            $table->foreign('activation_control_id')
                ->references('id')
                ->on('activation_controls')
                ->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('fixed_revenues');
    }
}
