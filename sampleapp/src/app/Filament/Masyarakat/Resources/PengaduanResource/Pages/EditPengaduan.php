<?php

namespace App\Filament\Masyarakat\Resources\PengaduanResource\Pages;

use App\Filament\Masyarakat\Resources\PengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditPengaduan extends EditRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($data['status'] === 'diteruskan') {
            Notification::make()
                ->danger()
                ->title('Pengaduan tidak bisa diedit')
                ->body('Pengaduan yang sudah diteruskan tidak dapat diubah.')
                ->send();

            $this->redirect(PengaduanResource::getUrl('index')); // Redirect kembali ke daftar
        }

        return $data;
    }
}
