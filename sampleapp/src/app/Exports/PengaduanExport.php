<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengaduanExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithStyles
{
    protected $filteredRecords;
    protected $kelurahan;
    protected $bulan;
    protected $tahun;

    public function __construct($filteredRecords, $kelurahan, $bulan, $tahun)
    {
        $this->filteredRecords = $filteredRecords;
        $this->kelurahan = $kelurahan;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return $this->filteredRecords->map(function ($pengaduan) {
            return [
                'ID' => $pengaduan->id,
                'Nama Pengguna' => $pengaduan->user->name,
                'Judul' => $pengaduan->judul,
                'Deskripsi' => $pengaduan->deskripsi,
                'Lokasi' => $pengaduan->lokasi,
                'Foto' => $pengaduan->foto,
                'Status' => $pengaduan->status,
                'Tanggal Pengaduan' => $pengaduan->created_at->format('Y-m-d H:i:s'),
                'Tanggal Terakhir Update' => $pengaduan->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            //
        ];
    }

    public function title(): string
    {
        return 'Pengaduan';
    }

    public function styles(Worksheet $sheet)
{
    // Title in the first row
    $sheet->setCellValue('A1', 'Data Pengaduan Selama ' . $this->kelurahan . ' Pada Bulan ' . $this->bulan . ' Tahun ' . $this->tahun);
    $sheet->mergeCells('A1:I1');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FEF9E1');  // Green background

    // Setting headers (row 2)
    $headers = ['ID', 'Nama Pengguna', 'Judul', 'Deskripsi', 'Lokasi', 'Foto', 'Status', 'Tanggal Pengaduan', 'Tanggal Terakhir Update'];
    foreach ($headers as $key => $header) {
        $sheet->setCellValueByColumnAndRow($key + 1, 2, $header);
    }

    // Header styles
    $sheet->getStyle('A2:I2')->getFont()->setBold(true)->setSize(12);
    $sheet->getStyle('A2:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
    $sheet->getStyle('A2:I2')->getFill()->getStartColor()->setRGB('E5D0AC');
    $sheet->getStyle('A2:I2')->getFill()->getEndColor()->setRGB('EBEAFF');
    $sheet->getStyle('A2:I2')->getFont()->getColor()->setRGB('343131');
    $sheet->getStyle('A2:I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Apply alternating row colors for data rows (from row 3 onward)
    $rowCount = $this->filteredRecords->count() + 2;  // total rows
    for ($i = 3; $i <= $rowCount; $i++) {
        $rowColor = ($i % 2 == 0) ? 'F1F1F1' : 'FFFFFF';  // Alternating row colors (gray and white)
        $sheet->getStyle('A' . $i . ':I' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB($rowColor);
    }

    // Apply thin borders to all cells (including header and data rows)
    $sheet->getStyle('A2:I' . ($rowCount))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    // Apply thicker border for header row (A2:I2)
    $sheet->getStyle('A2:I2')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

    // Font style for data rows
    $sheet->getStyle('A3:I' . ($rowCount))->getFont()->setSize(10);  // Smaller font size for data rows
    $sheet->getStyle('A3:I' . ($rowCount))->getFont()->setName('Arial');  // Arial font

    // Alignments for data columns
    $sheet->getStyle('A3:A' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);  // Center for ID
    $sheet->getStyle('B3:B' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);  // Left for Nama Pengguna
    $sheet->getStyle('C3:C' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);  // Left for Judul
    $sheet->getStyle('D3:D' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);  // Left for Deskripsi
    $sheet->getStyle('E3:E' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);  // Left for Lokasi
    $sheet->getStyle('F3:F' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);  // Left for Foto
    $sheet->getStyle('G3:G' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);  // Center for Status
    $sheet->getStyle('H3:H' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);  // Center for Tanggal Pengaduan
    $sheet->getStyle('I3:I' . ($rowCount))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);  // Center for Tanggal Terakhir Update

    // Row height adjustments for better readability
    $sheet->getRowDimension(1)->setRowHeight(25);  // Title row height
    $sheet->getRowDimension(2)->setRowHeight(20);  // Header row height
    for ($i = 3; $i <= $rowCount; $i++) {
        $sheet->getRowDimension($i)->setRowHeight(18);  // Data row height
    }

    // Auto column width for better readability
    foreach (range('A', 'I') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);  // Auto-size columns based on content
    }
}


}
