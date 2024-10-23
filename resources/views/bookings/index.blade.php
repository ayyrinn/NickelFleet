<x-app-layout>
    <div class="container mx-auto mt-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-center text-lg text-gray-800 dark:text-neutral-200">Vehicle Bookings</h2>
            <div>
                <a href="{{ route('bookings.export') }}" class="btn btn-secondary">Export</a>
                <a href="{{ route('bookings.create') }}" class="btn btn-primary">+ New Bookings</a>
            </div>
        </div>

        <div class="overflow-x-auto border rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead>
                    <tr class="bg-gray-100">
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">ID</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Vehicle</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Made By</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Driver</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Start Date</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">End Date</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th>
                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="bg-white hover:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $booking->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $booking->vehicle->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $booking->driver->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $booking->start_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $booking->end_date }}</td>
                            <td class="text-center border-b mt-2 mb-2">
                                @if ($booking->status === 'approved')
                                    <span class="inline-flex items-center bg-green-100 text-green-800 text-base font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                        Approved
                                    </span>
                                @elseif ($booking->status === 'pending')
                                    <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-base font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                        <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                        Pending
                                    </span>
                                @elseif ($booking->status === 'rejected')
                                    <span class="inline-flex items-center bg-red-100 text-red-800 text-base font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                        Rejected
                                    </span>
                                @elseif ($booking->status === 'completed')
                                    <span class="inline-flex items-center bg-blue-100 text-blue-800 text-base font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                        <span class="w-2 h-2 me-1 bg-blue-500 rounded-full"></span>
                                        Completed
                                    </span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('bookings.show', $booking) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none dark:text-blue-500 dark:hover:text-blue-400">
                                    <i class="fas fa-info-circle text-lg"></i>
                                </a>
                                <a href="{{ route('bookings.edit', $booking) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none dark:text-blue-500 dark:hover:text-blue-400">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none dark:text-red-500 dark:hover:text-red-400">
                                        <i class="fas fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
