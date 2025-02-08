<?php

namespace App\Events;

use App\Models\Pengaduan;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PengaduanBaruEvent
{
    use Dispatchable, SerializesModels;

    public Pengaduan $pengaduan;

    public function __construct(Pengaduan $pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }
}

