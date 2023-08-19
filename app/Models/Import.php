<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $table = 'import';
    protected $fillable = ['id', 'tender_id', 'file', 'oleh', 'created_at', 'updated_at'];

    public function tender()
    {
        return $this->belongsTo(Tender::class, 'tender_id');
    }
}
