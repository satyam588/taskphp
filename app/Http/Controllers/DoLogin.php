<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class DoLogin extends Controller
{
    public function index(Request $request) {
        // // return $request->post();

        $response = Http::asForm()->post('https://reqres.in/api/login', [
            'email' => $request->post('email'),
            'password' => $request->post('password'),
        ]);

        if ( !empty($response['token']) ) {

            $request->session()->put('token', $response['token']);
            $request->session()->put('email', $request->post('email'));

            return redirect('dashboard');

        }else {
            $request->session()->flash('error', 'Email or Password Was Incorrect!');
             return redirect('login');

        }

    }
}
