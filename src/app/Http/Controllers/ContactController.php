<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;


class ContactController extends Controller
{
    //
    public function contact()
    {
        return view('contact');
    }

    public function contactPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);

        Mail::send(
            'email',
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'comment' => $request->get('comment')
            ],
            function ($message) {
                $message->from('ev.trassierra@gmail.com');
                $message->to('ev.trassierra@gmail.com', 'Mensaje de Contacto')
                    ->subject('Formulario de contacto');
            }
        );

        return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
    }
}
