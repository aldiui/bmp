<?php
namespace App\Filament\Widgets;

use App\Models\Cpmi;
use App\Models\Gaji;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Models\Negara;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\LowonganKerja;
use App\Models\MataPelajaran;
use Spatie\Permission\Models\Role;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class DashboardOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s'; 

    protected function getStats(): array
    {
        return [
            Stat::make('Role', Role::count())
                ->icon('heroicon-o-shield-check'),
            Stat::make('User', User::count())
                ->icon('heroicon-o-users'),
            Stat::make('Jabatan', Jabatan::count())
                ->icon('heroicon-o-briefcase'),
            Stat::make('Gaji (Data)', Gaji::count())
                ->icon('heroicon-o-banknotes'),
            Stat::make('Kategori', Kategori::count())
                ->icon('heroicon-o-tag'),
            Stat::make('Negara', Negara::count())
                ->icon('heroicon-o-globe-europe-africa'),
            Stat::make('Lowongan Kerja', LowonganKerja::count())
                ->icon('heroicon-o-building-storefront'),
            Stat::make('Lokasi', Lokasi::count())
                ->icon('heroicon-o-map-pin'),
            Stat::make('Mata Pelajaran', MataPelajaran::count())
                ->icon('heroicon-o-academic-cap'),
            Stat::make('Kelas', Kelas::count())
                ->icon('heroicon-o-building-office-2'),
            Stat::make('CPMI', Cpmi::count())
                ->icon('heroicon-o-user-group'),
        ];
    }
}
