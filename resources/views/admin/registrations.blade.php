<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrations Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($events as $event)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Speaker: {{ $event->speaker }} | Location: {{ $event->location }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-bold text-indigo-500">{{ $event->registrations->count() }} / {{ $event->total_seats }}</span>
                            <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Registered</p>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        @if ($event->registrations->isEmpty())
                            <p class="text-center text-gray-500 py-4 italic">No users registered for this workshop yet.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">#</th>
                                            <th scope="col" class="px-6 py-3">Student Name</th>
                                            <th scope="col" class="px-6 py-3">Email</th>
                                            <th scope="col" class="px-6 py-3">Registration Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($event->registrations as $index => $registration)
                                            <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="px-6 py-4 font-medium">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $registration->user->name }}</td>
                                                <td class="px-6 py-4">{{ $registration->user->email }}</td>
                                                <td class="px-6 py-4">{{ $registration->created_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
