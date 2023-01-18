<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InformacionesMailable;
use Illuminate\Support\Facades\Mail;
use App\Models\Familiare;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class EnviarCorreoController extends Controller
{

    public function index(Request $request)
    {
        $email = $request['email'];
        return Inertia::render('Email/SendEmail', [
            'email' => $email
        ]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       /*  $correo = new InformacionesMailable;

        Mail::to($request['email'])->send($correo); */

        return Redirect::route('familiares.index')->with('success', 'Correo Enviado con éxito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
