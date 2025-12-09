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
        Schema::create('ticket_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ticket_id')->unsigned();
            $table->bigInteger('agent_id')->unsigned();
            $table->timestamp('assigned_at');
            $table->timestamp('unassigned_at')->nullable();

            $table->foreign('ticket_id', 'fk_ticket_id_in_ticket_assignments')
                    ->references('id')
                    ->on('tickets')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('agent_id', 'fk_agent_id_in_ticket_assignments')
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
        Schema::dropIfExists('ticket_assignments');
    }
};
