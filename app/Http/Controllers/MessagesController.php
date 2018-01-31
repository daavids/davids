<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'name' => 'required',
            'body' => 'required'
        ]);        

        // Create post
        $msg = new Message;
        $msg->email = $request->input('email');
        $msg->name = $request->input('name');
        $msg->body = $request->input('body');
        $msg->save();
        
        return redirect('/')->with('success', 'Message sent.');
    }
}
