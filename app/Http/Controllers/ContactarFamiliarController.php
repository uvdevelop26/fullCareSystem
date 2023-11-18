<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactarFamiliarMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ContactarFamiliarController extends Controller
{
    
    public function index($email){

        return Inertia::render('Email/SendEmail', ['email' => $email]);
    }

   
    public function enviarCorreo(Request $request){

        $request->validate([
            'email' => 'required',
            'mensaje' => 'required'
        ]);

     
        Mail::to($request->email)->send(new ContactarFamiliarMailable($request->mensaje));

        return Redirect::route('familiares.index')->with('success', 'Correo Enviado Exitosamente');
    }

    
    
}
