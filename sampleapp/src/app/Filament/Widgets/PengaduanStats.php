<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Pengaduan; // Pastikan model Pengaduan di-import

class PengaduanStats extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * //@var string
     */
   // protected static ?string $chartId = 'pengaduanStats';
    protected static ?string $heading = 'Statistik Pengaduan';
    protected static ?int $contentHeight = 350;

    /**
     * Widget Title
     *
     * @var string|null
     */
    

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        // Ambil data pengaduan diteruskan dan ditolak berdasarkan bulan
        $ditolak = Pengaduan::where('status', 'ditolak')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $diteruskan = Pengaduan::where('status', 'diteruskan')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Pastikan semua bulan ada dalam data, meskipun tanpa data pengaduan
        $ditolak = array_pad($ditolak, 12, 0);
        $diteruskan = array_pad($diteruskan, 12, 0);

        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Ditolak',
                    'data' => $ditolak, // Data pengaduan yang ditolak
                ],
                [
                    'name' => 'Diteruskan',
                    'data' => $diteruskan, // Data pengaduan yang diteruskan
                ],
            ],
            'xaxis' => [
                'categories' => ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b', '#10b981'], // Warna berbeda untuk masing-masing area
            'stroke' => [
                'curve' => 'smooth',
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shadeIntensity' => 1,
                    'opacityFrom' => 0.3,
                    'opacityTo' => 0.7,
                    'stops' => [0, 90, 100],
                ],
            ],
            'legend' => [
                'position' => 'top',
                'horizontalAlign' => 'center',
            ],
            'selection' => [
                'enabled' => false,
            ],
        ];
    }
}
