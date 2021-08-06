<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use DB;

class MessageController extends Controller
{
  
  public function chat(User $user)
  {
    $messages = DB::table('messages')->where('receiver_id',auth()->user()->id )
                        ->where( 'sender_id' ,$user->id )
                        ->orWhere('sender_id', auth()->user()->id)
                        ->get();
                       
    return view('messages.chat', compact('user', 'messages'));
  }

  public function store(Request $request, User $user)
  {
  
      $recieverId = $user->id;
      $senderId = auth()->user()->id;

      Message::create([
        'receiver_id' => $recieverId,
        'sender_id' => $senderId,
        'message' => $request->message
      ]);

      return back();
  }

}
