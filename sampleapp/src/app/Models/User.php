<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable implements HasAvatar
{
    
    use HasRoles, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_admin',
        'avatar_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }
    
    public function getFilamentAvatarUrl(): ?string
{
    $avatarColumn = config('filament-edit-profile.avatar_column', 'avatar_url');
    
    return $this->$avatarColumn
        ? Storage::url($this->$avatarColumn) // Gunakan disk 'public'
        : null;
}



     // Relasi ke Pengaduan
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class);
    }

     // Relasi ke Notifikasi
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function isAdmin(): bool
    {
        return $this->email == 'admin@kelurahan.com';
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // Pada model Masyarakat atau User
public function getRoleAttribute()
{
    // Pastikan kolom role ada pada database
    return $this->attributes['role']; // 'masyarakat' atau 'admin'
}


}
