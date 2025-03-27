<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $query = Order::query();

        // Ambil filter tanggal jika dipilih
        $dateRange = $this->filters['date_range'] ?? null;
        if ($dateRange) {
            $query->whereBetween('created_at', [
                now()->parse($dateRange['start'])->startOfDay(),
                now()->parse($dateRange['end'])->endOfDay(),
            ]);
        }

        // Ambil filter status jika dipilih
        $status = $this->filters['status'] ?? null;
        if ($status) {
            $query->where('status', $status);
        }

        return [
            Stat::make('Total Pesanan', $query->count())
                ->description('Jumlah pesanan yang telah dibuat')
                ->icon('heroicon-o-shopping-cart'),

            Stat::make('Pelanggan', $query->distinct('user_id')->count('user_id'))
                ->description('Jumlah pelanggan yang melakukan pemesanan')
                ->icon('heroicon-o-user-group'),

           
        ];
    }

    protected function getFilters(): array
    {
        return [
            DatePicker::make('date_range')
                ->label('Rentang Tanggal')
                ->default(now()->startOfMonth())
                ->range(),

            Select::make('status')
                ->label('Status Pesanan')
                ->options([
                    'pending' => 'Pending',
                    'completed' => 'Selesai',
                    'canceled' => 'Dibatalkan',
                ])
                ->placeholder('Semua Status'),
        ];
    }
}
