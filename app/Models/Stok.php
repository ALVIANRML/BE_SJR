<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stok extends Model
{
    protected $table = 'stok';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_item',
        'jumlah_item',
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

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function itemTebusan()
    {
        return $this->hasMany(ItemTebusan::class);
    }
}
