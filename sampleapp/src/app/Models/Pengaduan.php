<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\PengaduanBaruEvent;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans'; // Pastikan nama tabel sesuai dengan yang ada di database

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'lokasi',
        'foto',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    protected static function booted()
{
    static::created(function ($pengaduan) {
        event(new PengaduanBaruEvent($pengaduan));
    });
}

}