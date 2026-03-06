<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Workshops') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="mb-6 text-center">
                <p class="text-gray-600 dark:text-gray-400 text-lg">You are registered for <span class="font-bold text-indigo-500">{{ auth()->user()->registrations()->count() }} / 3</span> events.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    @php
                        $isRegistered = $event->registrations()->where('user_id', auth()->id())->exists();
                        $isFull = $event->remaining_seats <= 0;
                        $atMaxEvents = auth()->user()->registrations()->count() >= 3;
                    @endphp

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <div class="p-6 text-gray-900 dark:text-gray-100 flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold">{{ $event->title }}</h3>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $isFull ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $event->remaining_seats }} / {{ $event->total_seats }} Seats
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2"><strong>Speaker:</strong> {{ $event->speaker }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4"><strong>Location:</strong> {{ $event->location }}</p>
                        </div>
                        
                        <div class="p-6 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                            @if ($isRegistered)
                                <button disabled class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-bold py-2 px-4 rounded cursor-not-allowed">
                                    Registered
                                </button>
                            @elseif ($isFull)
                                <button disabled class="w-full bg-red-300 dark:bg-red-900 text-red-800 dark:text-red-200 font-bold py-2 px-4 rounded cursor-not-allowed">
                                    Closed
                                </button>
                            @else
                                <form action="{{ route('events.register', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full font-bold py-2 px-4 rounded {{ $atMaxEvents ? 'bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700 text-white' }}"
                                            {{ $atMaxEvents ? 'disabled' : '' }}
                                            @if(!$atMaxEvents) onclick="return confirm('Register for {{ addslashes($event->title) }}?');" @endif
                                    >
                                        Register
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
