<x-app-layout>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <h4 class="font-semibold text-lg text-center">Vehicle Usage Frequency</h4>
                        <canvas id="vehicleUsageChart"></canvas>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <h4 class="font-semibold text-lg text-center">Vehicle Usage Duration</h4>
                        <canvas id="vehicleDurationChart"></canvas>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row justify-between items-start mb-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 w-full">
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md flex flex-col justify-between">
                            <h4 class="font-semibold text-lg text-center">Usage Based on Fuel Type</h4>
                            <canvas id="fuelUsageChart" class="h-40"></canvas>
                        </div>

                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md flex flex-col justify-between">
                            <h4 class="font-semibold text-lg text-center">Usage Based on Type</h4>
                            <canvas id="typeUsageChart" class="h-40"></canvas>
                        </div>

                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md flex flex-col justify-between">
                            <h4 class="font-semibold text-lg text-center">Vehicle Booking Status</h4>
                            <canvas id="bookingStatusChart" class="h-40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const vehicleUsageCtx = document.getElementById('vehicleUsageChart').getContext('2d');
        new Chart(vehicleUsageCtx, {
            type: 'bar',
            data: {
                labels: @json($vehicleUsage->pluck('vehicle_name')),
                datasets: [{
                    label: 'Usage Frequency',
                    data: @json($vehicleUsage->pluck('usage_count')),
                    backgroundColor: '#36A2EB'
                }]
            }
        });

        const vehicleDurationCtx = document.getElementById('vehicleDurationChart').getContext('2d');
        new Chart(vehicleDurationCtx, {
            type: 'bar',
            data: {
                labels: @json($vehicleDurations->pluck('vehicle_name')),
                datasets: [{
                    label: 'Average Duration (days)',
                    data: @json($vehicleDurations->pluck('avg_duration')),
                    backgroundColor: '#FFCE56'
                }]
            }
        });

        const fuelUsageCtx = document.getElementById('fuelUsageChart').getContext('2d');
        new Chart(fuelUsageCtx, {
            type: 'pie',
            data: {
                labels: @json($fuelUsage->pluck('fuel_type')),
                datasets: [{
                    label: 'Fuel Usage',
                    data: @json($fuelUsage->pluck('usage_count')),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            }
        });

        const typeUsageCtx = document.getElementById('typeUsageChart').getContext('2d');
        new Chart(typeUsageCtx, {
            type: 'pie',
            data: {
                labels: @json($typeUsage->pluck('type')),
                datasets: [{
                    label: 'Vehicle Type Usage',
                    data: @json($typeUsage->pluck('usage_count')),
                    backgroundColor: ['#4BC0C0', '#FF6384']
                }]
            }
        });

        const bookingStatusCtx = document.getElementById('bookingStatusChart').getContext('2d');
        new Chart(bookingStatusCtx, {
            type: 'doughnut',
            data: {
                labels: @json($bookingStatuses->pluck('status')),
                datasets: [{
                    label: 'Booking Status',
                    data: @json($bookingStatuses->pluck('status_count')),
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
                }]
            }
        });
    </script>
</x-app-layout>
