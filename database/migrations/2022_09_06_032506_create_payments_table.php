<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('mount',6,2);
            $table->string('pay_email',50);
            $table->datetime('pay_date');
            $table->string('pay_token',50);
            $table->string('pay_first_name',20);
            $table->string('pay_last_name',20);
            $table->string('pay_country',20);
            $table->string('pay_currencycode',20);
            $table->decimal('pay_mount',6,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
