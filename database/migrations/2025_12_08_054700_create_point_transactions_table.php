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
        Schema::create('point_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loyalty_point_id')->unsigned();
            $table->integer('used_point');
            $table->timestamp('created_at');

            $table->foreign('loyalty_point_id', 'fk_loyalty_point_id_in_point_transactions')
                ->references('id')
                ->on('loyalty_points')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_transactions');
    }
};
