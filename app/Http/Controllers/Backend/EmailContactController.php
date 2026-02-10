<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactSubmission;

class EmailContactController extends Controller
{
    public function sendContactForm(ContactFormRequest $request)
    {
        // Validation is already handled by ContactFormRequest
        $validated = $request->validated();

        ContactSubmission::create($validated);

        try {
            Mail::to('sakhilathami2001@gmail.com')->send(new ContactFormMail($validated));
            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            \Log::error('Contact form email error: ' . $e->getMessage());
            return back()->with('success', 'Your message has been received! We\'ll get back to you soon.');
        }
    }
    public function index()
{
    $contacts = ContactSubmission::latest()->paginate(15);
    return view('admin.contact-submissions.index', compact('contacts'));
}

}
