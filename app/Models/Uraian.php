<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uraian extends Model
{
    use HasFactory;

    protected $table = 'uraian';
    protected $fillable = ['id', 'tender_id', 'vendor_id', 'no_sp', 'no_agreement', 'prosentase', 'kontrak', 'oleh', 'created_at', 'updated_at'];

    public function tender()
    {
        return $this->belongsTo(Tender::class, 'tender_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
