<?php

use Filament\Tables;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengaduanExport;
use App\Models\Pengaduan; 
use Illuminate\Support\Facades\DB;

class PengaduanExportModal extends Component
{
    public $filter = '1_bulan_terakhir';
    public $open = false;

    public function render()
    {
        return view('filament.resources.pengaduan-export-modal');
    }

    public function exportToExcel()
    {
        // Ambil data berdasarkan filter
        $pengaduans = \App\Models\Pengaduan::query();

        switch ($this->filter) {
            case '7_hari_terakhir':
                $pengaduans->whereBetween('created_at', [now()->subDays(6), now()]);
                break;
            case '2_minggu_terakhir':
                $pengaduans->whereBetween('created_at', [now()->subWeeks(2), now()]);
                break;
            case '1_bulan_terakhir':
                $pengaduans->whereBetween('created_at', [now()->subMonth(), now()]);
                break;
            case 'per_minggu':
                $pengaduans->groupBy(DB::raw('WEEK(created_at)'));
                break;
        }

        // Ekspor data ke Excel
        return Excel::download(new PengaduanExportModal($pengaduans), 'pengaduan.xlsx');
    }
}
