<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function index(Request $request)
    {
        // Paginate the results
        $messages = ContactUs::with('user')
                             ->latest()
                             ->when($request->search, function ($query) use ($request) {
                                 $query->where('subject', 'like', '%' . $request->search . '%')
                                       ->orWhere('message', 'like', '%' . $request->search . '%');
                             })
                             ->paginate(5);  // You can change 10 to any number you prefer
    
        // Pass the paginated results to the view
        return view('admin.contactus.index', compact('messages'));
    }
    
    public function show($id)
    {
        // Fetch the message with its related user details
        $message = ContactUs::with('user')->findOrFail($id);
    
        // Mark the message as read
        $message->update(['is_read' => 1]);
    
        // Return the view for showing the message details
        return redirect()->route('contactus.index')->with('success', 'Message marked as read.');
    }
    
    
    public function update(Request $request, $id)
{
    // Fetch the message to be updated
    $message = ContactUs::findOrFail($id);

    // Validate the incoming request data
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Update the message with new data
    $message->update([
        'subject' => $request->input('subject'),
        'message' => $request->input('message'),
    ]);

    // Optionally mark the message as read after updating
    $message->update(['is_read' => 1]);

    // Redirect back to the contact us page or show a success message
    return redirect()->route('contactus.index')->with('success', 'Message updated successfully.');
}


    public function destroy($id)
    {
        $contactus = ContactUs::findOrFail($id);
    
        $contactus->delete();

        return redirect()->route('contactus.index')->with('success', 'تم حذف الرسالة بنجاح.');
    }

    public function markAsRead($id)
    {
        // Find the message
        $message = ContactUs::findOrFail($id);
    
        // Mark it as read
        $message->update(['is_read' => 1]);
    
        // Return a JSON response
        return response()->json(['success' => 1]);
    }
    

}