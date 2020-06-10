<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserFriend;
use App\Message;
use App\Events\NewMessage;
use Auth;

class ContactsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function uniqueContacts(){
        // get all users that received/sent message from/to [Auth user]
        $users = Message::join('users',  function ($join) {
            $join->on('messages.from_id', '=', 'users.id')
                ->orOn('messages.to_id', '=', 'users.id');
        })
            ->where('messages.from_id', Auth::user()->id)
            ->orWhere('messages.to_id', Auth::user()->id)
            ->orderBy('messages.created_at', 'desc')
            ->get()
            ->unique('id');
        return $users;
    }

    public function get()
    {
         // get all users except the authenticated one
        $contacts = User::where('id', '!=', auth()->id())->get();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from_id` as sender_id,`body` as body, count(`from_id`) as messages_count'))
            ->where('to_id', auth()->id())
            ->where('seen', false)
            ->groupBy('from_id')
            ->groupBy('body')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            $contact->body = $contactUnread ? $contactUnread->body : '';

            return $contact;
        });


        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function ($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function ($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })
            ->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $messageID = mt_rand(9, 999999999) + time();
        $message = Message::create([
            'id' => $messageID,
            'from_id' => auth()->id(),
            'to_id' => $request->contact_id,
            'body' => $request->body,
            'type' => 'user',
        ]);
        $user = auth('api')->user();
        if (!$user->tutor->where('student_id', $request->contact_id)->first()) {

            $user->tutor()->create(['student_id' => $request->contact_id]);
        }
        // broadcast(new NewMessage(auth()->user(), $message->load('fromContact')))->toOthers();
        // broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
