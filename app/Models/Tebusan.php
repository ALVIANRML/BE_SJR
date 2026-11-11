<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Tebusan extends Model
{
    protected $table = 'tebusan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_kredit_limit',
        'nama_pt',
        'nomor_sh',
        'nomor_tebusan',
        'metode_tebusan',
        'tanggal',
        'tanggal_so',
        'nomor_qt',
        'nomor_so',
        'harga_tebusan',
        'tanggal_berita_acara',
        'tanggal_jatuh_tempo',
        'jumlah_tebusan',
        'tanggal_pelunasan_tebusan',
        'harga_pelunasan',
        'form_permintaan',
        'form_qt',
        'form_so',
        'bukti_pembayaran',
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

    public function kredit_limit()
    {
        return $this->belongsTo(KreditLimit::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemTebusan::class, 'id_tebusan', 'id');
    }
}
