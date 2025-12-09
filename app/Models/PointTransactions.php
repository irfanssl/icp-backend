<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransactions extends Model
{
    use HasFactory;

    /**
     * table name
     */
    protected $table = 'point_transactions';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'loyalty_point_id',
        'used_point',
        'created_at'
    ];

     /**
     * relation to loyalty_points
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function points(){
        return $this->hasOne(LoyaltyPoints::class, 'id', 'loyalty_point_id');
    }
}
