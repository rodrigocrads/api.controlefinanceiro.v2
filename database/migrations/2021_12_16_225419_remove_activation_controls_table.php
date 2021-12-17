<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveActivationControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('activation_controls');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('activation_controls', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('expiration_day');
            $table->enum('periodicity', [
                'monthly', 'quarterly', 'semiannual', 'annual'
            ]);;

            $table->integer('fixed_revenue_id')
                ->nullable()
                ->unsigned();
            $table->foreign('fixed_revenue_id')
                ->references('id')
                ->on('fixed_revenues')
                ->onDelete('cascade');

            $table->integer('fixed_expense_id')
                ->nullable()
                ->unsigned();
            $table->foreign('fixed_expense_id')
                ->references('id')
                ->on('fixed_expenses')
                ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }
}
