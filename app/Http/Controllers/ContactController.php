<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;

use Auth;


class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {   
        if($request->validated()){
            $contact = new Contact();
            
            $user_id ='';

            if(Auth::check()){
                $user_id = Auth::guard('user')->user()['id'] != null ? Auth::guard('user')->user()['id']: Auth::guard('user')->user()['id'];
            }
            
            $contact->create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ]);

            return response()->json('OK');
        }
    }
}
