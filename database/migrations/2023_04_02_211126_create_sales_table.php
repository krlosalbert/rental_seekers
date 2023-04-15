<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('number_rooms');
            $table->float('parking');
            $table->float('canon');
            $table->float('referencia');
            $table->float('comprobante');
            $table->float('terminos');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('neighborhood_id')->unsigned();
            $table->bigInteger('property_id')->unsigned();
            $table->bigInteger('advisor_id')->unsigned();
            $table->bigInteger('account_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
