<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Message_recipient;
use Illuminate\Support\Facades\DB;

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

    public function getSentMessage(Request $request) {
        try {
            
            /** @var Message $messages */
        $messages = DB::table('messages')
        ->select('messages.*', 'users.id as recipient_id', 'users.name as recipient_name')
        ->where('messages.sender_id', '=', $request['user_id'])
        ->join('message_recipients', 'messages.id', '=', 'message_recipients.message_id')
        ->join('users', 'message_recipients.recipient_id' ,'=', 'users.id')
        ->get();
        return response()->json(['data' => $messages, 'message' => 'Success']);
            //\Log::error($request);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something went wrong while loading Message!',
                'error' => $e->getMessage(),
            ],500);
        }
       
    }

    public function getReceivedMessage(Request $request) {
        try {
            
            /** @var Message $messages */
        $messages = DB::table('messages')
        ->select('messages.*', 'users.id as sender_id', 'users.name as sender_name')
        ->where('message_recipients.recipient_id', '=', $request['user_id'])
        ->join('message_recipients', 'messages.id', '=', 'message_recipients.message_id')
        ->join('users', 'messages.sender_id' ,'=', 'users.id')
        ->get();
        return response()->json(['data' => $messages, 'message' => 'Success']);
            //\Log::error($request);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something went wrong while loading Message!',
                'error' => $e->getMessage(),
            ],500);
        }
       
    }
}
