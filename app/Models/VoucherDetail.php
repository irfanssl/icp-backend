<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherDetail extends Model
{
    use HasFactory;

    protected $table = 'voucher_details';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'voucher_id',
        'user_id',
        'nominal',
        'is_used'
    ];


    public function voucher(){
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
    
    public function customer(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
