<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ItemTebusan extends Model
{
    protected $table = 'item_tebusan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_stok',
        'id_tebusan',
        'jumlah',
        'harga',
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->id = (string) Str::uuid();
        });
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class);
    }

    public function tebusan(): BelongsTo
    {
        return $this->belongsTo(Tebusan::class, 'id_tebusan', 'id');
    }
}
