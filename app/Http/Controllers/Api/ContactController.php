<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;
use App\Mail\NewContactReceived;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:500'
        ]);

        $newContact = new Contact();

        $newContact->name = $data["name"];
        $newContact->email = $data["email"];
        $newContact->message = $data["message"];

        $newContact->save();

        // Email di conferma all'utente che ha compilato il form
        Mail::to($data['email'])->send(new NewContact($data));

        // mi invio una mail per notificare un nuovo contatto
        Mail::to('dario.fusco@boolean.it')->send(new NewContactReceived($data));

        return response()->json([
            'message' => "Thank you {$data['name']} for your message. We will be in touch soon."
        ], 201);
    }
}
