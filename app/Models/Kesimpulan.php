<?php

namespace App\Models;

use App\Models\Disposisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kesimpulan extends Model
{
    use HasFactory;
    protected $table = 'kesimpulan';

    protected $fillable = [
        'surat_id',
        'disposisi_id',
        'keputusan',
        'hasil',
        'tindakan',
        'keterangan',
    ];
    
}
