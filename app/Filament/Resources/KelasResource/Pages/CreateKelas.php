<?php
namespace App\Filament\Resources\KelasResource\Pages;

use App\Filament\Resources\KelasResource;
use App\Models\JadwalPelajaran;
use Filament\Resources\Pages\CreateRecord;

class CreateKelas extends CreateRecord
{
    protected static string $resource = KelasResource::class;

    protected function afterCreate(): void
    {
        $kelas = $this->record;

        $hariKerja = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
        ];

        foreach ($hariKerja as $hari) {
            JadwalPelajaran::create([
                'kelas_id' => $kelas->id,
                'hari'     => $hari,
                'libur'    => false,
            ]);
        }

        $hariLibur = ['Sabtu', 'Minggu'];
        foreach ($hariLibur as $hari) {
            JadwalPelajaran::create([
                'kelas_id' => $kelas->id,
                'hari'     => $hari,
                'libur'    => true,
            ]);
        }
    }
}
