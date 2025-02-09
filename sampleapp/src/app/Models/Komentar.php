<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = ['pengaduan_id', 'user_id', 'pesan', 'parent_id'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
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
