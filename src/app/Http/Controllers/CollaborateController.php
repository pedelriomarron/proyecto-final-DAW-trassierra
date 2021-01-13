<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\CollaborateFormMail;

class CollaborateController extends Controller
{
    public function index()
    {
        return view('collaborate'); //renders the collaborate page
    }

    public function send_mail(Request $request)
    {
        $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
            'screenshot' => ['required']
        ]);

        $collaborate = [
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'subject' => $request['subject'],
            'message' => $request['message'],
            'screenshot' =>  $request->file('screenshot')->store('collaborate', 'public')
        ];

        Mail::to('ev.trassierra@gmail.com')->send(new CollaborateFormMail($collaborate));

        return redirect()->route('collaborate')->with('status', ' Your Mail has been received');
    }
}
