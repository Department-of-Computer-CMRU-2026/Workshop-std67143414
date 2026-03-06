<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center space-x-4">
                    <div>
                        <h3 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">You are registered for <span class="font-bold text-indigo-500">{{ $userRegistrations->count() }} / 3</span> events.</p>
                    </div>
                    <div>
                        <a href="{{ route('workshops') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                            Browse Workshops
                        </a>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4 px-2">My Registered Events</h3>

            @if ($userRegistrations->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700">
                    <div class="p-10 text-gray-500 text-center">
                        <p class="text-lg">You have not registered for any events yet.</p>
                        <a href="{{ route('workshops') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700 underline">Find a workshop</a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($userRegistrations as $registration)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col border-l-4 border-blue-500">
                            <div class="p-6 text-gray-900 dark:text-gray-100 flex-grow">
                                <h3 class="text-xl font-bold mb-4">{{ $registration->event->title }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2"><strong>Speaker:</strong> {{ $registration->event->speaker }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4"><strong>Location:</strong> {{ $registration->event->location }}</p>
                                <div class="pt-4 mt-auto border-t border-gray-100 dark:border-gray-700">
                                    <p class="text-xs text-gray-400">Registered at: {{ $registration->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
