<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = "vendor";

    protected $fillable = ['id', 'no', 'vendor', 'created_at', 'updated_at'];

    public function uraian()
    {
        return $this->hasMany(Uraian::class, 'vendor_id');
    }
}
