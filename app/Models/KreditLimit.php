<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KreditLimit extends Model
{
    protected $table = 'kredit_limit';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_segment',
        'id_perusahaan',
        'total_kredit',
        'sisa_limit',
    ];

    public $timestamps = true;

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function tebusan()
    {
        return $this->hasMany(Tebusan::class);
    }
}
