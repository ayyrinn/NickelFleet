<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Approval;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = Vehicle::all(); 
        $drivers = Driver::all(); 

        $approversLevel1 = User::where('role', 'approver')->where('level', 1)->get();
        $approversLevel2 = User::where('role', 'approver')->where('level', 2)->get();
        
        return view('bookings.create', compact('vehicles', 'drivers', 'approversLevel1', 'approversLevel2'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'approver_level_1' => 'required|exists:users,id',
            'approver_level_2' => 'required|exists:users,id',
        ]);

        $booking = Booking::create([
            'vehicle_id' => $request->vehicle_id,
            'user_id' => Auth::id(),
            'driver_id' => $request->driver_id,
            'destination' => $request->destination,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'booking_date' => now(),
        ]);

        Approval::create([
            'booking_id' => $booking->id,
            'approved_by' => $validatedData['approver_level_1'],
            'approval_level' => 1,
        ]);
    
        Approval::create([
            'booking_id' => $booking->id,
            'approved_by' => $validatedData['approver_level_2'],
            'approval_level' => 2,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show($id)
    {
        $booking = Booking::with(['vehicle', 'driver', 'approvals.approver'])->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        $approvals = Approval::where('booking_id', $id)->first();

        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $approvers = User::where('role', 'approver')->get();
        $admins = User::where('role', 'admin')->get();

        return view('bookings.edit', compact('booking', 'approvals', 'vehicles', 'drivers', 'approvers', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,approved,rejected,completed',
            'made_by' => 'required|exists:users,id',
            'approvers.1' => 'required|exists:users,id',
            'approvers.2' => 'required|exists:users,id',
        ]);

    
        $booking = Booking::findOrFail($id);

        $booking->vehicle_id = $request->input('vehicle_id');
        $booking->driver_id = $request->input('driver_id');
        $booking->destination = $request->input('destination');
        $booking->start_date = $request->input('start_date');
        $booking->end_date = $request->input('end_date');
        $booking->status = $request->input('status');
        $booking->save();

        foreach ($request->input('approvers') as $level => $approver_id) {
            Approval::updateOrCreate(
                ['booking_id' => $id, 'approval_level' => $level],
                ['approved_by' => $approver_id]
            );
        }

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully');
    }

    public function export()
    {
        Log::info('Export bookings called');
        return Excel::download(new BookingsExport, 'bookings.xlsx');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
