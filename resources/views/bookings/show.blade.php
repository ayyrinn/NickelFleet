<x-app-layout>
    <div class="container mx-auto mt-4">
        <h2 class="text-center text-xl text-bold text-gray-800 dark:text-neutral-200">Booking Details #{{ $booking->id }}</h2>
        <div class="text-center mt-2 mb-2">
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
        </div>

        <div class="mt-6 mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-neutral-200">Vehicle:</label>
                <input type="text" value="{{ $booking->vehicle->name }}" readonly class="mt-1 block w-full text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-neutral-200">Driver:</label>
                <input type="text" value="{{ $booking->driver->name }}" readonly class="mt-1 block w-full text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-neutral-200">Destination:</label>
                <input type="text" value="{{ $booking->destination }}" readonly class="mt-1 block w-full text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-neutral-200">Start Date:</label>
                <input type="text" value="{{ $booking->start_date }}" readonly class="mt-1 block w-full text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-neutral-200">End Date:</label>
                <input type="text" value="{{ $booking->end_date }}" readonly class="mt-1 block w-full text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-800 dark:text-neutral-200">Booking Date:</label>
                <input type="text" value="{{ $booking->booking_date }}" readonly class="mt-1 block w-full text-gray-800 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100">
            </div>
        </div>

        <h2 class="text-center text-xl text-bold text-gray-800 dark:text-neutral-200">Approval Log</h2>
        <div class="mt-6">
            <ol class="flex items-center">
                <!-- Booking Made -->
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-100 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[150px]">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Bookings Made</h3>
                            <p>Made by: {{ $booking->user->name }}</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-500">{{ $booking->booking_date }}</p>
                        </div>
                    </div>
                </li>

                <!-- Approval Level 1 -->
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 {{ $booking->approvals[0]->status === 'approved' ? 'bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900' : 'bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-700' }} sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 {{ $booking->approvals[0]->status === 'approved' ? 'text-blue-100 dark:text-blue-300' : 'text-gray-900 dark:text-white' }} " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                        <div class="flex w-full {{ $booking->approvals[0]->status === 'approved' ? 'bg-blue-600' : 'bg-gray-200' }} h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[150px]">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Approval Level 1</h3>
                            @if ($booking->approvals[0]->status === 'pending')
                                <p>Waiting for: {{ $booking->approvals[0]->approver->name }}</p>
                            @else
                                <p>Approved by: {{ $booking->approvals[0]->approver->name }}</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-500">{{ $booking->approvals[0]->updated_at}}</p>
                            @endif
                            @if (!empty($booking->approvals[0]->notes))
                                <strong>Notes:</strong> {{ $booking->approvals[0]->notes }}
                            @endif
                        </div>
                    </div>
                </li>

                <!-- Approval Level 2 -->
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 {{ $booking->approvals[1]->status === 'approved' ? 'bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900' : 'bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-700' }} sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="flex w-3 h-3 {{ $booking->approvals[1]->status === 'approved' ? 'text-blue-100 dark:text-blue-300' : 'text-gray-900 dark:text-white' }} " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[150px]">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Approval Level 2</h3>
                            @if ($booking->approvals[1]->status === 'pending')
                                <p>Waiting for: {{ $booking->approvals[1]->approver->name }}</p>
                            @else
                                <p>Approved by: {{ $booking->approvals[1]->approver->name }}</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-500">{{ $booking->approvals[1]->updated_at}}</p>
                            @endif
                        </div>
                    </div>
                </li>

                <!-- Booking Approved -->
                <li class="relative w-full mb-6">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 {{ $booking->status === 'approved' ? 'bg-blue-600 rounded-full ring-0 ring-white dark:bg-blue-900' : 'bg-gray-200 rounded-full ring-0 ring-white dark:bg-gray-700' }} sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="flex w-3 h-3 {{ $booking->status === 'approved' ? 'text-blue-100 dark:text-blue-300' : 'text-gray-900 dark:text-white' }} " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[150px]">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Bookings Approved</h3>
                            @if ($booking->status === 'approved')
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-500">{{ $booking->updated_at}}</p>
                            @endif
                        </div>
                    </div>
                </li>
            </ol>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
        </div>
    </div>
</x-app-layout>
