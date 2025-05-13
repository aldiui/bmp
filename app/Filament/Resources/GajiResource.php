<?php
namespace App\Filament\Resources;

use App\Filament\Resources\GajiResource\Pages;
use App\Models\Gaji;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use \App\Models\User;

class GajiResource extends Resource
{
    protected static ?string $model = Gaji::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Gaji';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?string $slug = 'gaji';

    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Penggajian')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Karyawan')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $user = User::find($state);
                                    if ($user && $user->jabatan) {
                                        $set('gaji_pokok', $user->jabatan->gaji_pokok);
                                    }
                                }
                            }),
                        Forms\Components\Select::make('bulan')
                            ->label('Bulan')
                            ->required()
                            ->default(ltrim(date('m'), '0'))
                            ->options([
                                '1' => 'Januari',
                                '2' => 'Februari',
                                '3' => 'Maret',
                                '4' => 'April',
                                '5' => 'Mei',
                                '6' => 'Juni',
                                '7' => 'Juli',
                                '8' => 'Agustus',
                                '9' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember',
                            ]),
                        Forms\Components\Select::make('tahun')
                            ->label('Tahun')
                            ->required()
                            ->options(function () {
                                $currentYear = date('Y');
                                $years       = [];
                                for ($i = 0; $i < 10; $i++) {
                                    $year         = $currentYear - $i;
                                    $years[$year] = $year;
                                }
                                return $years;
                            })
                            ->default(date('Y')),
                    ])
                    
                    ->columns(3),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('gaji_pokok')
                            ->label('Gaji Pokok')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('tunjangan')
                            ->label('Tunjangan Jabatan')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('bonus')
                            ->label('Bonus')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('tunjangan_pajak')
                            ->label('Tunjangan Pajak')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                    ])
                    ->columns(1)
                    ->columnSpan(1)
                    ->heading('Pemasukan')
                    ->extraAttributes(['class' => 'bg-green-50 border-green-200']),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('bpjs_jht')
                            ->label('BPJS JHT (2%)')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('bpjs_kesehatan')
                            ->label('BPJS Kesehatan (1%)')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('pph_21')
                            ->label('PPH 21')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('pinjaman')
                            ->required()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => self::updatePerhitungan($set, $get))
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                    ])
                    ->columns(1)
                    ->columnSpan(1)
                    
                    ->heading('Pengeluaran')
                    ->extraAttributes(['class' => 'bg-red-50 border-red-200']),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('gaji_kotor')
                            ->label('Total Penerimaan')
                            ->readonly()
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('potongan')
                            ->label('Total Potongan')
                            ->readonly()
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                        Forms\Components\TextInput::make('gaji_bersih')
                            ->label('Take Home Pay')
                            ->readonly()
                            ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 0)
                            ->prefix('Rp')
                            ->numeric(),
                    ])
                    ->columns(3)
                    ->columnSpan(['lg' => 2])
                    
                    ->heading('Ringkasan Gaji')
                    ->extraAttributes(['class' => 'bg-blue-50 border-blue-200']),
            ])->columns(['lg' => 2]);
    }

    private static function updatePerhitungan(Forms\Set $set, Forms\Get $get): void
    {
        $gajiPokok = (int)($get('gaji_pokok') ?? 0);
        $tunjangan = (int)($get('tunjangan') ?? 0);
        $bonus = (int)($get('bonus') ?? 0);
        $tunjanganPajak = (int)($get('tunjangan_pajak') ?? 0);
        $gajiKotor = $gajiPokok + $tunjangan + $bonus + $tunjanganPajak;
        $set('gaji_kotor', $gajiKotor);
        $bpjsJht = (int)($get('bpjs_jht') ?? 0);
        $bpjsKesehatan = (int)($get('bpjs_kesehatan') ?? 0);
        $pph21 = (int)($get('pph_21') ?? 0);
        $pinjaman = (int)($get('pinjaman') ?? 0);
        $potongan = $bpjsJht + $bpjsKesehatan + $pph21 + $pinjaman;
        $set('potongan', $potongan);
        $gajiBersih = $gajiKotor - $potongan;
        $set('gaji_bersih', $gajiBersih);
    }

    public static function hydrate(Form $form): void
    {
        $form->getState(function (array $state) use ($form) {
            $state['gaji_pokok'] = $state['gaji_pokok'] ?? 0;
            $state['tunjangan'] = $state['tunjangan'] ?? 0;
            $state['bonus'] = $state['bonus'] ?? 0;
            $state['tunjangan_pajak'] = $state['tunjangan_pajak'] ?? 0;
            $state['bpjs_jht'] = $state['bpjs_jht'] ?? 0;
            $state['bpjs_kesehatan'] = $state['bpjs_kesehatan'] ?? 0;
            $state['pph_21'] = $state['pph_21'] ?? 0;
            $state['pinjaman'] = $state['pinjaman'] ?? 0;
            $gajiKotor = $state['gaji_pokok'] + $state['tunjangan'] + $state['bonus'] + $state['tunjangan_pajak'];
            $form->fill(['gaji_kotor' => $gajiKotor]);
            $potongan = $state['bpjs_jht'] + $state['bpjs_kesehatan'] + $state['pph_21'] + $state['pinjaman'];
            $form->fill(['potongan' => $potongan]);
            $gajiBersih = $gajiKotor - $potongan;
            $form->fill(['gaji_bersih' => $gajiBersih]);
        });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Karyawan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bulan')
                    ->label('Bulan')
                    ->formatStateUsing(function ($state) {
                        $bulanList = [
                            '1' => 'Januari',
                            '2' => 'Februari',
                            '3' => 'Maret',
                            '4' => 'April',
                            '5' => 'Mei',
                            '6' => 'Juni',
                            '7' => 'Juli',
                            '8' => 'Agustus',
                            '9' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember',
                        ];
                        return $bulanList[$state] ?? $state;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gaji_kotor')
                    ->label('Total Penerimaan')
                    ->numeric()
                    ->prefix('Rp ')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('potongan')
                    ->label('Total Potongan')
                    ->numeric()
                    ->prefix('Rp ')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gaji_bersih')
                    ->label('Take Home Pay')
                    ->numeric()
                    ->prefix('Rp ')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Karyawan')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('bulan')
                    ->label('Bulan')
                    ->default(ltrim(date('m'), '0'))
                    ->options([
                        '1' => 'Januari',
                        '2' => 'Februari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli', 
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ]),
                Tables\Filters\SelectFilter::make('tahun')
                    ->label('Tahun')
                    ->default(date('Y'))
                    ->options(function () {
                        $currentYear = date('Y');
                        $years = [];
                        for ($i = 0; $i < 10; $i++) {
                            $year = $currentYear - $i;
                            $years[$year] = $year;
                        }
                        return $years; 
                    }),
                Tables\Filters\TrashedFilter::make(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make("Pdf")
                    ->label('Slip Gaji')
                    ->color('success')
                    ->icon('heroicon-s-arrow-down-tray')
                    ->url(fn(Gaji $record) => route('admin.gaji.slip-gaji', ['id' => $record->id]))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGajis::route('/'),
            'create' => Pages\CreateGaji::route('/create'),
            'edit'   => Pages\EditGaji::route('/{record}/edit'),
        ];
    }
}