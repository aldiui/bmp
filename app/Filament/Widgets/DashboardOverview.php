<?php
namespace App\Filament\Widgets;

use App\Models\Cpmi;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Models\LowonganKerja;
use App\Models\MataPelajaran;
use App\Models\Negara;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Permission\Models\Role;

class DashboardOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        return [
            Stat::make('Role', Role::count())
                ->icon('heroicon-o-shield-check')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('primary'),
            Stat::make('User', User::count())
                ->icon('heroicon-o-users')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('success'),
            Stat::make('Jabatan', Jabatan::count())
                ->icon('heroicon-o-briefcase')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('info'),
            Stat::make('Gaji (Data)', Gaji::count())
                ->icon('heroicon-o-banknotes')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('warning'),
            Stat::make('Kategori', Kategori::count())
                ->icon('heroicon-o-tag')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('danger'),
            Stat::make('Negara', Negara::count())
                ->icon('heroicon-o-globe-europe-africa')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('primary'),
            Stat::make('Lowongan Kerja', LowonganKerja::count())
                ->icon('heroicon-o-building-storefront')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('success'),
            Stat::make('Lokasi', Lokasi::count())
                ->icon('heroicon-o-map-pin')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('info'),
            Stat::make('Mata Pelajaran', MataPelajaran::count())
                ->icon('heroicon-o-academic-cap')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('warning'),
            Stat::make('Kelas', Kelas::count())
                ->icon('heroicon-o-building-office-2')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('danger'),
            Stat::make('CPMI', Cpmi::count())
                ->icon('heroicon-o-user-group')
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('primary'),
        ];
    }
}
