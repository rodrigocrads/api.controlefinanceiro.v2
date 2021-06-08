<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivationControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activation_controls', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->integer('activation_day')->nullable(false);
            $table->enum('activation_type', [
                'monthly', 'quarterly', 'semiannual', 'annual'
            ])
            ->nullable(false);

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
        Schema::dropIfExists('activation_controls');
    }
}
