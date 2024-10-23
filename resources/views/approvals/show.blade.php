<x-app-layout>
    <div class="container mx-auto mt-4">
        <h2 class="text-center text-xl text-bold text-gray-800 dark:text-neutral-200">Approval Details Booking #{{ $booking->id }}</h2>
        <div class="text-center mt-2 mb-2">
            @if ($approval->status === 'approved')
                <span class="inline-flex items-center bg-green-100 text-green-800 text-base font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                    Approved
                </span>
            @elseif ($approval->status === 'pending')
                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-base font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                    <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                    Pending
                </span>
            @elseif ($approval->status === 'rejected')
                <span class="inline-flex items-center bg-red-100 text-red-800 text-base font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                    Rejected
                </span>
            @endif
        </div>

        <!-- Booking Details -->
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

        <!-- Approval Log -->
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
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[100px]">
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
                            <svg class="w-2.5 h-2.5 {{ $booking->approvals[0]->status === 'approved' ? 'text-blue-100 dark:text-blue-300' : 'text-gray-900 dark:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                        <div class="flex w-full {{ $booking->approvals[0]->status === 'approved' ? 'bg-blue-600' : 'bg-gray-200' }} h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[100px]">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Approval Level 1</h3>
                            @if ($booking->approvals[0]->status === 'pending')
                                <p>Waiting for: {{ $booking->approvals[0]->approver->name }}</p>
                            @else
                                <p>by: {{ $booking->approvals[0]->approver->name }}</p>
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
                            <svg class="flex w-3 h-3 {{ $booking->approvals[1]->status === 'approved' ? 'text-blue-100 dark:text-blue-300' : 'text-gray-900 dark:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </div>
                        <div class="flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[100px]">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Approval Level 2</h3>
                            @if ($booking->approvals[1]->status === 'pending')
                                <p>Waiting for: {{ $booking->approvals[1]->approver->name }}</p>
                            @else
                                <p>by: {{ $booking->approvals[1]->approver->name }}</p>
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
                    <div class="mt-3 text-left flex flex-col justify-between min-h-[100px]">
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

        <!-- Update Approval Status -->
        @if(auth()->user()->role === 'approver')
            @php
                $canUpdateStatus = false;
                if (auth()->user()->level === 2 && $booking->approvals[0]->status === 'approved' && $booking->status !== 'approved') {
                    $canUpdateStatus = true;
                } elseif (auth()->user()->level === 1 && $booking->status !== 'approved') {
                    $canUpdateStatus = true;
                }
            @endphp

            @if ($canUpdateStatus)
                <div class="mt-2">
                    <button id="updateStatusBtn" class="btn btn-primary">Update Approval Status</button>
                </div>
            @endif
        @endif

        <!-- Modal for Updating Status -->
        <div id="updateStatusModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                <h3 class="text-lg font-bold">Update Approval Status</h3>
                <form action="{{ route('approvals.update', $approval->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="approval_id" value="{{ $approval->id }}">
                    <div class="mt-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Select Status</label>
                        <select id="status" name="status" required class="mt-1 block w-full text-gray-700">
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const updateStatusBtn = document.getElementById('updateStatusBtn');
            const updateStatusModal = document.getElementById('updateStatusModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const statusSelect = document.getElementById('status');
            const notesContainer = document.getElementById('notesContainer');

            updateStatusBtn.addEventListener('click', () => {
                updateStatusModal.classList.remove('hidden');
            });

            closeModalBtn.addEventListener('click', () => {
                updateStatusModal.classList.add('hidden');
            });

            statusSelect.addEventListener('change', function () {
                notesContainer.classList.toggle('hidden', this.value !== 'rejected');
            });
        });
    </script>
</x-app-layout>
