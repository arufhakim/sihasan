<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'tender';
    protected $fillable = ['id', 'no_pr', 'tender', 'bagian_id', 'periode_awal', 'periode_akhir', 'keterangan', 'oleh', 'slug', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['periode_awal', 'periode_akhir', 'deleted_at'];

    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'tender_id');
    }

    public function uraian()
    {
        return $this->hasMany(Uraian::class, 'tender_id');
    }

    public function checking($tender_id)
    {
        return $this->pekerjaan->where('tender_id', $tender_id)->count() > 0;
    }

    public function import()
    {
        return $this->hasMany(Import::class, 'tender_id');
    }

    public function bagian()
    {
        return $this->belongsToMany(Bagian::class, 'bagian_tender');
    }
}
