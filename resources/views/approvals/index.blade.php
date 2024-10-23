<x-app-layout>
    <div class="container mx-auto mt-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-center text-lg text-gray-800 dark:text-neutral-200">Approval Requests</h2>
            
            @if(auth()->user()->role === 'admin')
                <div class="flex items-center">
                    <select name="approver_id" id="approver_id" class="border rounded-md px-2 py-1">
                        <option value="" class="text-gray-500">Select Approver</option>
                        @foreach ($approvers as $id => $name)
                            <option value="{{ $id }}" class="text-gray-500">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        <div class="overflow-x-auto border rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead>
                    <tr class="bg-gray-100">
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">ID</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Booking ID</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Approved By</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Notes</th>
                        @if(auth()->user()->role === 'admin')
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Approval Level</th>
                        @endif
                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approvals as $approval)
                        <tr class="bg-white hover:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $approval->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $approval->booking_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">
                                {{ $approval->approver->name ?? 'N/A' }}
                            </td>
                            <td class="text-center border-b mt-2 mb-2">
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $approval->notes }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $approval->approval_level }}</td>
                            @endif
                            <td class="py-2 px-4 border-b text-end">
                                <a href="{{ route('approvals.show', $approval) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none dark:text-blue-500 dark:hover:text-blue-400">
                                    <i class="fas fa-info-circle text-lg"></i>
                                </a>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('approver_id').addEventListener('change', function() {
            const selectedValue = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('approver_id', selectedValue);
            window.location.href = url.toString();
        });
    </script>
</x-app-layout>
