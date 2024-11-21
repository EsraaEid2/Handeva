<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index()
    {
        // Fetch messages with user details, sorted by latest
        $messages = ContactUs::with('user')->latest()->get();

        // Pass messages to the index view
        return view('admin.contact_us.index', compact('messages'));
    }

    /**
     * Display a specific message.
     */
    public function show($id)
    {
        $message = ContactUs::with('user')->findOrFail($id);
        return view('admin.contact_us.show', compact('message'));
    }
    
    /**
     * Delete a specific message.
     */
    public function destroy($id)
    {
        $contactus = ContactUs::findOrFail($id);
    
        // Perform a soft delete
        $contactus->delete($id);


        // Redirect back with a success message
        return redirect()->route('contact_us.index')->with('success', 'Message deleted successfully.');
    }
}