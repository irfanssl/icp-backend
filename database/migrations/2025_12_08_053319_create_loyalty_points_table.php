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
        Schema::create('loyalty_points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->string('batch_code')->comment('PROMO_JAN_2025');
            $table->timestamp('expired_date');
            $table->integer('initial_point')->comment('jumlah point awal yg diberikan utk setiap batch');

            $table->foreign('customer_id', 'fk_customer_id_in_loyalty_points')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('set null');
            $table->unique(['customer_id', 'batch_code']); // each record : per customer per batch
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_points');
    }
};
