<x-app-layout>
    <div class="container mx-auto mt-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-center text-lg text-gray-800 dark:text-neutral-200">Vehicles</h2>
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary">+ New Vehicle</a>
        </div>

        <div class="overflow-x-auto border rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead>
                    <tr class="bg-gray-100">
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">ID</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Type</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Plate Number</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Owned</th>
                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr class="bg-white hover:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $vehicle->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $vehicle->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">
                                @if($vehicle->type === 'orang')
                                    <i class="fas fa-user"></i>
                                @elseif($vehicle->type === 'barang')
                                    <i class="fas fa-box"></i>
                                @else
                                    {{ $vehicle->type }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 border-b">{{ $vehicle->plate_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-b">
                                @if($vehicle->is_rented)
                                    <span class="text-red-600 dark:text-red-400">Rented</span>
                                @else
                                    <span class="text-green-600 dark:text-green-400">Owned</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('vehicles.show', $vehicle) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none dark:text-blue-500 dark:hover:text-blue-400">
                                    <i class="fas fa-info-circle text-lg"></i>
                                </a>
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none dark:text-blue-500 dark:hover:text-blue-400">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
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
