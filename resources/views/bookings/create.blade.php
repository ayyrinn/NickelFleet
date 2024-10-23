<x-app-layout>
    <div class="container mx-auto mt-4">
        <h2 class="text-center text-xl text-gray-800 dark:text-neutral-200">Create New Booking</h2>

        <form action="{{ route('bookings.store') }}" method="POST" class="mt-6">
            @csrf

            <div class="mt-6 mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-2">
                    <label for="vehicle_id" class="block text-base font-medium text-gray-800 dark:text-neutral-200">Vehicle</label>
                    <select id="vehicle_id" name="vehicle_id" required class="pl-3 h-12 mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" class="text-gray-500">Select a vehicle</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" class="text-gray-500">{{ $vehicle->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="driver_id" class="block text-base font-medium text-gray-800 dark:text-neutral-200">Driver</label>
                    <select id="driver_id" name="driver_id" required class="pl-3 h-12 mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" class="text-gray-500">Select a driver</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}" class="text-gray-500">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="approver_level_1" class="block text-base font-medium text-gray-800 dark:text-neutral-200">Approver Level 1</label>
                    <select id="approver_level_1" name="approver_level_1" required class="pl-3 h-12 mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" class="text-gray-500">Select an approver</option>
                        @foreach ($approversLevel1 as $approver)
                            <option value="{{ $approver->id }}" class="text-gray-500">{{ $approver->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="start_date" class="block text-base font-medium text-gray-800 dark:text-neutral-200">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required class="h-12 mt-1 block w-full border-gray-300 text-gray-500 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>


                <div class="mb-2">
                    <label for="approver_level_2" class="block text-base font-medium text-gray-800 dark:text-neutral-200">Approver Level 2</label>
                    <select id="approver_level_2" name="approver_level_2" required class="pl-3 h-12 mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" class="text-gray-500">Select an approver</option>
                        @foreach ($approversLevel2 as $approver)
                            <option value="{{ $approver->id }}" class="text-gray-500">{{ $approver->name }}</option>
                        @endforeach
                    </select>
                </div>

                

                <div class="mb-2">
                    <label for="end_date" class="block text-base font-medium text-gray-800 dark:text-neutral-200">End Date</label>
                    <input type="date" id="end_date" name="end_date" required class="h-12 mt-1 block w-full border-gray-300 text-gray-500 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>

            <div class="mb-2">
                <label for="destination" class="block text-base font-medium text-gray-800 dark:text-neutral-200">Destination</label>
                <input type="text" id="destination" name="destination" required class="h-12 mt-1 block w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Enter destination">
            </div>

            <div class="mb-2 flex items-center justify-between">
                <button type="submit" class="btn btn-primary">Create Booking</button>
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
