<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Models\Driver;
use App\Models\DeliveryOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index()
    {
        $fleetStats = [
            'total' => Fleet::count(),
            'active' => Fleet::where('status', 'active')->count(),
        ];

        $driverStats = Driver::withCount('deliveryOrders')->get();

        return view('reports.index', compact('fleetStats', 'driverStats'));
    }

    public function export()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=driver_performance.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Driver Name', 'Total Orders', 'Rating']);

            Driver::all()->each(function ($driver) use ($file) {
                fputcsv($file, [$driver->name, $driver->delivery_orders_count ?? 0, $driver->rating]);
            });

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
