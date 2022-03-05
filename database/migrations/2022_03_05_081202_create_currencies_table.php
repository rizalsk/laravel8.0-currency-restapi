<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
            * code - a currency code (e.g. EUR)
            * name - a currency name (Euro)
            * rate - a currency rate to USD or EUR at your choice (4.6554)
            * date - a curency stats date 
        */

        Schema::create('currency', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->string('name')->nullable();
            $table->double('rate')->default(0);
            $table->date('date')->nullable();
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
        Schema::dropIfExists('currencies');
    }
}
