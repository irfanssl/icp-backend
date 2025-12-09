<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAssignment extends Model
{
    use HasFactory;

    protected $table = 'ticket_assignments';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',
        'agent_id',
        'assigned_at',
        'unassigned_at',
    ];

    /**
     * relation to tickets
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket(){
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }


    /**
     * relation to users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent(){
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }
}
