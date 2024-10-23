<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class BookingsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Booking::with(['approvals.approver', 'vehicle', 'driver'])
            ->get()
            ->map(function ($booking) {
                $approver1 = $booking->approvals->where('approval_level', 1)->first();
                $approver2 = $booking->approvals->where('approval_level', 2)->first();

                return [
                    'ID' => $booking->id,
                    'Vehicle' => $booking->vehicle->name,
                    'Made By' => $booking->user->name,
                    'Driver' => $booking->driver->name,
                    'Start Date' => $booking->start_date,
                    'End Date' => $booking->end_date,
                    'Status' => $booking->status,
                    'Approver 1' => optional($approver1)->approved_by ? optional($approver1->approver)->name : null, // Ambil nama approver
                    'Approver 1 Status' => optional($approver1)->status,
                    'Notes Approver 1' => optional($approver1)->notes,
                    'Approver 2' => optional($approver2)->approved_by ? optional($approver2->approver)->name : null, // Ambil nama approver
                    'Approver 2 Status' => optional($approver2)->status,
                    'Notes Approver 2' => optional($approver2)->notes,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Vehicle',
            'Made By',
            'Driver',
            'Start Date',
            'End Date',
            'Status',
            'Approver 1',
            'Approver 1 Status',
            'Notes Approver 1',
            'Approver 2',
            'Approver 2 Status',
            'Notes Approver 2',
        ];
    }
}
