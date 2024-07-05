<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsOfBookingsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    


    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;

        $bookings = DB::table('bookings')
            ->select(
                DB::raw('MONTH(date) as month'),
                DB::raw('COUNT(*) as total_bookings'),
                DB::raw('SUM(total) as total_value'),
                DB::raw('SUM(CASE WHEN payment_status = "paid" THEN total ELSE 0 END) as total_paid_value'),
                DB::raw('SUM(CASE WHEN payment_status = "pending" THEN total ELSE 0 END) as total_unpaid_value'),
                DB::raw('COUNT(CASE WHEN payment_status = "paid" THEN 1 ELSE NULL END) as total_paid_bookings'),
                DB::raw('COUNT(CASE WHEN payment_status = "pending" THEN 1 ELSE NULL END) as total_unpaid_bookings')
            )
            ->whereYear('date', $currentYear)
            ->groupBy(DB::raw('MONTH(date)'))
            ->get();

        // Initialize an array with zeros for each month
        $data = array_fill(1, 12, [
            'total_bookings' => 0,
            'total_value' => 0,
            'total_paid_value' => 0,
            'total_unpaid_value' => 0,
            'total_paid_bookings' => 0,
            'total_unpaid_bookings' => 0
        ]);

        // Fill the data array with the bookings data
        foreach ($bookings as $booking) {
            $data[$booking->month]['total_bookings'] = $booking->total_bookings;
            $data[$booking->month]['total_value'] = $booking->total_value;
            $data[$booking->month]['total_paid_value'] = $booking->total_paid_value;
            $data[$booking->month]['total_unpaid_value'] = $booking->total_unpaid_value;
            $data[$booking->month]['total_paid_bookings'] = $booking->total_paid_bookings;
            $data[$booking->month]['total_unpaid_bookings'] = $booking->total_unpaid_bookings;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Bookings',
                    'data' => array_column($data, 'total_bookings'),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
                [
                    'label' => 'Total Value',
                    'data' => array_column($data, 'total_value'),
                    'backgroundColor' => '#FF6384',
                    'borderColor' => '#FFB1C1',
                ],
                [
                    'label' => 'Paid Bookings',
                    'data' => array_column($data, 'total_paid_bookings'),
                    'backgroundColor' => '#4BC0C0',
                    'borderColor' => '#C9E7E7',
                ],
                [
                    'label' => 'Unpaid Bookings',
                    'data' => array_column($data, 'total_unpaid_bookings'),
                    'backgroundColor' => '#FFCD56',
                    'borderColor' => '#FFDB7D',
                ],
                [
                    'label' => 'Paid Value',
                    'data' => array_column($data, 'total_paid_value'),
                    'backgroundColor' => '#9966FF',
                    'borderColor' => '#D7B8FF',
                ],
                [
                    'label' => 'Unpaid Value',
                    'data' => array_column($data, 'total_unpaid_value'),
                    'backgroundColor' => '#FF9F40',
                    'borderColor' => '#FFCD80',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    

    protected static bool $isLazy = true;

    protected static ?string $pollingInterval = null;

    protected function getType(): string
    {
        return 'bar';
    }
}
