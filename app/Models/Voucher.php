<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VoucherLevel;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';
    public $timestamps = false;

    protected $casts = [
        'level' => VoucherLevel::class
    ];

    protected $fillable = [
        'level',
        'expired_at'
    ];

    public function details(){
        return $this->hasMany(VoucherDetail::class, 'voucher_id', 'id');
    }
    
}
