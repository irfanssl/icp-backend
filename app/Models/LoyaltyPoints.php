<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPoints extends Model
{
    use HasFactory;

    protected $table = 'loyalty_points';
    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'batch_code',
        'expired_date',
        'initial_point'
    ];

    /**
     * relation to user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer(){
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    /**
     * relation to point_transactions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(){
        return $this->hasMany(PointTransactions::class, 'loyalty_point_id', 'id');
    }
}
