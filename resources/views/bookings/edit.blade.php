<x-app-layout>
    <div class="container mx-auto mt-4">
        <h2 class="text-center text-xl text-gray-800 dark:text-neutral-200">Edit Booking</h2>

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $booking->id }}">

            <div class="mt-6 mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Vehicle Dropdown -->
                <div>
                    <label for="vehicle_id" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Vehicle</label>
                    <select id="vehicle_id" name="vehicle_id" required class="pl-3 mt-1 block w-full h-12 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
                        <option value="" class="text-gray-500">Select a vehicle</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ $booking->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Start Date -->
                <div>
                    <label for="start_date" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $booking->start_date }}" required class="mt-1 block w-full h-12 border-gray-300 text-gray-500 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Driver Dropdown -->
                <div>
                    <label for="driver_id" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Driver</label>
                    <select id="driver_id" name="driver_id" required class="pl-3 mt-1 block w-full h-12 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
                        <option value="" class="text-gray-500">Select a driver</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ $booking->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">End Date</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $booking->end_date }}" required class="mt-1 block w-full h-12 border-gray-300 text-gray-500 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Destination Input -->
                <div>
                    <label for="destination" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Destination</label>
                    <input type="text" id="destination" name="destination" value="{{ $booking->destination }}" required class="mt-1 block w-full h-12 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100" placeholder="Enter destination">
                </div>

                <!-- Booking Date -->
                <div>
                    <label for="booking_date" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Booking Date</label>
                    <input type="date" id="booking_date" name="booking_date" value="{{ $booking->booking_date }}" required class="mt-1 block w-full h-12 border-gray-300 text-gray-500 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Booking Status Dropdown -->
                <div>
                    <label for="status" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Booking Status</label>
                    <select id="status" name="status" required class="pl-3 mt-1 block w-full h-12 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            
                <!-- Made by (Admin) Dropdown -->
                <div>
                    <label for="made_by" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Made By (Admin)</label>
                    <select id="made_by" name="made_by" required class="pl-3 mt-1 block w-full h-12 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}" {{ $booking->made_by == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="approver_level_1" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Approver Level 1</label>
                    <select id="approver_level_1" name="approvers[1]" required class="pl-3 mt-1 block w-full h-12 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
                        <option value="">Select an approver</option>
                        @foreach ($approvers as $approver)
                            <option value="{{ $approver->id }}" {{ $approvals->where('approval_level', 1)->first()->approved_by == $approver->id ? 'selected' : '' }}>
                                {{ $approver->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="approver_level_2" class="block text-base font-medium text-gray-800 dark:text-neutral-200 text-left">Approver Level 2</label>
                    <select id="approver_level_2" name="approvers[2]" required class="pl-3 mt-1 block w-full h-12 text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
                        <option value="">Select an approver</option>
                        @foreach ($approvers as $approver)
                            <option value="{{ $approver->id }}" {{ $approvals->where('approval_level', 2)->first()->approved_by == $approver->id ? 'selected' : '' }}>
                                {{ $approver->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            

            <!-- Submit Button -->
            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="btn btn-primary">Update Booking</button>
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
