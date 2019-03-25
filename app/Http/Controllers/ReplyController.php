<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class ReplyController extends Controller
{
    public function store(Request $request){
    	$this->validate($request, [

    		'reply' => 'required'
    	]);

    	$reply = new Reply();
    	$reply->user_id = Auth::id();
    	$reply->post_id = $request->post_id;
    	$reply->comment_id = $request->comment_id;
    	$reply->reply = $request->reply;
    	$reply->save();

    	Toastr::success('Reply Successfully Published :)' ,'Success');

    	return redirect()->back();
    }
}
