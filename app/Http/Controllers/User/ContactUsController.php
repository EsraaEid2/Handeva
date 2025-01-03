<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'contact_subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save the contact message
        ContactUs::create([
            'user_id' => auth()->id() ?? null, // null for guests
            'subject' => $request->contact_subject,
            'message' => $request->message,
        ]);

        // Redirect back with a success message for SweetAlert
        return redirect()->back()->with('successSent', __('Your message has been sent successfully!'));
    }
}