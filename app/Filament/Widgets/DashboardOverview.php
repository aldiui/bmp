<?php
namespace App\Filament\Widgets;

use App\Models\Cpmi;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Models\MataPelajaran;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Permission\Models\Role;

class DashboardOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '30s'; // Optional auto refresh

    protected function getStats(): array
    {
        return [
            Stat::make('Total User', User::count())
                ->icon('heroicon-o-users'),
            Stat::make('Total Role', Role::count())
                ->icon('heroicon-o-shield-check'),
            Stat::make('Total Jabatan', Jabatan::count())
                ->icon('heroicon-o-briefcase'),
            Stat::make('Total Gaji (Data)', Gaji::count())
                ->icon('heroicon-o-banknotes'),
            Stat::make('Total CPMI', Cpmi::count())
                ->icon('heroicon-o-user-group'),
            Stat::make('Total Lokasi', Lokasi::count())
                ->icon('heroicon-o-map-pin'),
            Stat::make('Total Mata Pelajaran', MataPelajaran::count())
                ->icon('heroicon-o-academic-cap'),
            Stat::make('Total Kelas', Kelas::count())
                ->icon('heroicon-o-building-office-2'),
        ];
    }
}
