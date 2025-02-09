<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Notifications\KomentarNotification;
use App\Events\KomentarBaru;

class Komentar extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['pengaduan_id', 'user_id', 'pesan', 'parent_id'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    protected static function booted()
{
    static::created(function ($komentar) {
        event(new KomentarBaru($komentar));

        $pengaduan = Pengaduan::find($komentar->pengaduan_id);
        $admin = User::where('role', 'admin')->first(); // Ambil admin
        if ($admin) {
            $admin->notify(new KomentarNotification([
                'user_name' => $komentar->user->name,
                'pengaduan_id' => $komentar->pengaduan_id,
                'pesan' => $komentar->pesan,
            ]));
        }
    });
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Komentar::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'parent_id');
    }
}
