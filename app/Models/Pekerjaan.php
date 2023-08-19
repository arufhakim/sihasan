<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan';
    protected $fillable = ['id', 'tender_id', 'pekerjaan', 'volume', 'satuan', 'harga', 'keterangan', 'created_at', 'updated_at'];
    
    public function tender()
    {
        return $this->belongsTo(Tender::class, 'tender_id');
    }
}
