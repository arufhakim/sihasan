<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;

    protected $table = "bagian";

    protected $fillable = ['id', 'bagian', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'bagian_user');
    }

    public function tender()
    {
        return $this->belongsToMany(Tender::class, 'bagian_tender');
    }
}
