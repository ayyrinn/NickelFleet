<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $vehicleUsage = Booking::join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->select('vehicles.name as vehicle_name', DB::raw('COUNT(bookings.id) as usage_count'))
            ->groupBy('vehicles.name')
            ->get();

        $vehicleDurations = Booking::join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->select('vehicles.name as vehicle_name', DB::raw('AVG(DATEDIFF(end_date, start_date)) as avg_duration'))
            ->groupBy('vehicles.name')
            ->get();

        $fuelUsage = Booking::join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->select('fuel_type', DB::raw('COUNT(bookings.id) as usage_count'))
            ->groupBy('fuel_type')
            ->get();

        $typeUsage = Booking::join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->select('vehicles.type', DB::raw('COUNT(bookings.id) as usage_count'))
            ->groupBy('vehicles.type')
            ->get();

        $bookingStatuses = Booking::select('status', DB::raw('COUNT(id) as status_count'))
            ->groupBy('status')
            ->get();

        return view('dashboard', [
            'vehicleUsage' => $vehicleUsage,
            'vehicleDurations' => $vehicleDurations,
            'fuelUsage' => $fuelUsage,
            'typeUsage' => $typeUsage,
            'bookingStatuses' => $bookingStatuses,
        ]);
    }
}
