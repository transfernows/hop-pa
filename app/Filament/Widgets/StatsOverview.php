<?php

namespace App\Filament\Widgets;

use App\Models\Onaylicart;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget {

    protected function getStats(): array {

        return [
            Stat::make('Günlük Yatırım', $this->todayAmount()),
            Stat::make('Red yatırım ', '21 TL'),
            Stat::make('Günlük Yatırım Sayıs', $this->todayadd()),
        ];
    }

    /**
     * 
     * @return type
     */
    private function todayadd() {
        return Onaylicart::where('status', '1')->count();
    }

    private function todayAmount() {

        return Onaylicart::where('status', '1')->sum('amount');
    }
    private function CanceltodayAmount() {

        return Onaylicart::where('status', '1')->sum('amount');
    }
}
