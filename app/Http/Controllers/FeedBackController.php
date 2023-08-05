<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Feedback;
use App\Http\Requests\FeedBackRequest;

use Auth;

class FeedBackController extends Controller
{
    public function store(FeedBackRequest $request)
    {
        if ($request->validated()) {
            $feedback = new FeedBack();

            $user_id = '';

            if (Auth::check()) {
                $user_id = Auth::guard('user')->user()['id'] != null ? Auth::guard('user')->user()['id'] : Auth::guard('user')->user()['id'];
            }

            $result = $feedback->create([
                'email' => $request->email,
                'user_id' => $user_id,
                'rating' => $request->rate,
                'comment' => $request->comment,
            ]);

            return response()->json($result);
        }
    }
}
