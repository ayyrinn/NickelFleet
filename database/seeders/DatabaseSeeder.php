<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Approval;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminadmin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'approver1@gmail.com',
            'password' => bcrypt('approver'),
            'role' => 'approver',
            'level' => 1,
        ]);

        User::create([
            'name' => 'Sekar Putri',
            'email' => 'approver2@gmail.com',
            'password' => bcrypt('approver'),
            'role' => 'approver',
            'level' => 2,
        ]);

        Vehicle::factory(5)->create();
        Driver::factory(5)->create();

        $admin = User::where('role', 'admin')->first();
        $approver1 = User::where('role', 'approver')->where('level', 1)->first();
        $approver2 = User::where('role', 'approver')->where('level', 2)->first();

        $booking1 = Booking::create([
            'vehicle_id' => 1,
            'user_id' => $admin->id,
            'driver_id' => 1,
            'destination' => 'Location A',
            'start_date' => now(),
            'end_date' => now()->addDays(2),
            'status' => 'pending',
            'booking_date' => now(),
        ]);
        Approval::create(['booking_id' => $booking1->id, 'approved_by' => $approver1->id, 'approval_level' => 1, 'status' => 'pending']);
        Approval::create(['booking_id' => $booking1->id, 'approved_by' => $approver2->id, 'approval_level' => 2, 'status' => 'pending']);

        $booking2 = Booking::create([
            'vehicle_id' => 2,
            'user_id' => $admin->id,
            'driver_id' => 2,
            'destination' => 'Location B',
            'start_date' => now(),
            'end_date' => now()->addDays(1),
            'status' => 'rejected',
            'booking_date' => now(),
        ]);
        Approval::create(['booking_id' => $booking2->id, 'approved_by' => $approver1->id, 'approval_level' => 1, 'status' => 'rejected']);
        Approval::create(['booking_id' => $booking2->id, 'approved_by' => $approver2->id, 'approval_level' => 2, 'status' => 'pending']);

        $booking3 = Booking::create([
            'vehicle_id' => 3,
            'user_id' => $admin->id,
            'driver_id' => 3,
            'destination' => 'Location C',
            'start_date' => now(),
            'end_date' => now()->addDays(3),
            'status' => 'approved',
            'booking_date' => now(),
        ]);
        Approval::create(['booking_id' => $booking3->id, 'approved_by' => $approver1->id, 'approval_level' => 1, 'status' => 'approved']);
        Approval::create(['booking_id' => $booking3->id, 'approved_by' => $approver2->id, 'approval_level' => 2, 'status' => 'approved']);

        $booking4 = Booking::create([
            'vehicle_id' => 4,
            'user_id' => $admin->id,
            'driver_id' => 4,
            'destination' => 'Location D',
            'start_date' => now()->subDays(5),
            'end_date' => now()->subDays(3),
            'status' => 'completed',
            'booking_date' => now()->subDays(6),
        ]);
        Approval::create(['booking_id' => $booking4->id, 'approved_by' => $approver1->id, 'approval_level' => 1, 'status' => 'approved']);
        Approval::create(['booking_id' => $booking4->id, 'approved_by' => $approver2->id, 'approval_level' => 2, 'status' => 'approved']);
    }
}
