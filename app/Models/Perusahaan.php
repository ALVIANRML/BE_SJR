<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
    ];

    public $timestamps = true;

    public function item(){
        return $this->hasMany(Item::class);
    }

    public function kreditLimit(){
        return $this->hasMany(KreditLimit::class);
    }

}
