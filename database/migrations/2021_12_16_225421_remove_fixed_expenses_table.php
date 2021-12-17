<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFixedExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('fixed_expenses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('fixed_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 100)->nullable(false);
            $table->string('description', 255)->nullable();
            $table->double('value')->nullable(false);

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->softDeletes();
            $table->timestamps();
        });
    }
}
