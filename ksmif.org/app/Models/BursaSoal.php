<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BursaSoal extends Model
{
    protected $table = 'bursa_soal';
    protected $fillable = [
        'matkul_id',
        'nama_file',
        'uploaded_by', //di isi ID user 
        'tahun',
        'path',
        'tipe' //['UTS', 'UAS', 'Quiz', 'Latihan']
    ];

    function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    
    function matkul(): BelongsTo
    {
        return $this->belongsTo(Matkul::class);
    }
}
