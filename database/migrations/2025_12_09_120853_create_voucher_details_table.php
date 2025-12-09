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
        Schema::create('voucher_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('voucher_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('nominal'); // 1000, 2000, etc
            $table->boolean('is_used')->default(false);

            $table->foreign('voucher_id', 'fk_voucher_id_in_voucher_details')
                    ->references('id')
                    ->on('vouchers')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('user_id', 'fk_user_id_in_voucher_details')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_details');
    }
};
