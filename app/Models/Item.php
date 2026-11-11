<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    protected $table = 'item';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_segment',
        'nama_item',
        'kemasan',
        'jumlah_liter',
        'harga_jual',
        'harga_tebus',
    ];

    public $timestamp = true;

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->id = (string) Str::uuid();
        });
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }
}
