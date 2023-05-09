<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Message_recipient;

class MessageController extends Controller
{
    //
    public function createMessage(Request $request) {
        try {
            
            /** @var Message $message */
            $message = Message::create(['subject' => $request['subject'], 'message_body' => $request['message_body'],
                                'sender_id' => $request['sender_id'], 'created_at' => now(), 'updated_at' => now()]);
            $receiver = Message_recipient::create(['recipient_id' => $request['receiver_id'], 'message_id' => $message['id'], 
                                            'created_at' => now(), 'updated_at' => now()]);
            
            return response()->json(['message' => $message, 'message' => 'Message sent successfully']);
            //\Log::error($request);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while sending Message!',
                'error' => $e->getMessage(),
            ],500);
        }
       
    }
}
