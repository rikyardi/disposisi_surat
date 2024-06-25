<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'perihal',
        'keterangan',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function disposisi(): HasMany
    {
        return $this->hasMany(Disposisi::class);
    }
}
