<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // Check if user already registered for this event
        if ($event->registrations()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You are already registered for this event.');
        }

        // Check max 3 events
        if (auth()->user()->registrations()->count() >= 3) {
            return back()->with('error', 'You can only register for a maximum of 3 events.');
        }

        // Check remaining seats
        if ($event->remaining_seats <= 0) {
            return back()->with('error', 'This event is fully booked.');
        }

        Registration::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ]);

        return back()->with('success', 'Successfully registered for ' . $event->title);
    }
}
