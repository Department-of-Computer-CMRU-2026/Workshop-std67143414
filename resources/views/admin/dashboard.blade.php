<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Events -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ $eventsCount }}</div>
                        <h3 class="text-lg font-medium">Total Events</h3>
                    </div>
                </div>

                <!-- Total Registrations -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <div class="text-4xl font-bold text-green-600 mb-2">{{ $registrationsCount }}</div>
                        <h3 class="text-lg font-medium">Total Registrations</h3>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        <div class="text-4xl font-bold text-purple-600 mb-2">{{ $usersCount }}</div>
                        <h3 class="text-lg font-medium">Total Students</h3>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ route('events.index') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg shadow">
                    Go to Manage Events &rarr;
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
