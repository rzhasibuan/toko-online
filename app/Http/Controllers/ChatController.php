<?php

namespace App\Http\Controllers;

use App\Models\Feature\Chat;
use App\Models\Feature\ChatRepley;
use App\Models\User;
use App\Repositories\CrudRepositories;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chat;
    protected $chats_id;

    public function __construct(ChatRepley $chat, Chat $chats)
    {
        $this->chat = new CrudRepositories($chat);
        $this->chats_id = new CrudRepositories($chats);
    }

    public function index()
    {

        $chat_id = ChatRepley::where('user_id', auth()->user()->id)->get()->first();

        if (!$chat_id == null) {
            $roomChat = ChatRepley::where('chat_id', $chat_id->chat_id)->orderBy('created_at', 'asc')->get();
            return view('frontend.chat.index', [
                'room_chat' => $roomChat,
                'room_id' => $chat_id->chat_id,
            ]);

        } else {
            return view('frontend.chat.index', [
                'room_id' => null,
            ]);
        }

    }

    public function show($id)
    {

        $chat_id = ChatRepley::where('user_id', $id)->get()->first();

        if (!$chat_id == null) {
            $roomChat = ChatRepley::where('chat_id', $chat_id->chat_id)->orderBy('created_at', 'asc')->get();
            return view('backend.feature.pesan.show', [
                'room_chat' => $roomChat,
                'room_id' => $chat_id->chat_id,
            ]);

        } else {
            return view('backend.feature.pesan.show', [
                'room_id' => null,
            ]);
        }

    }

    public function lists()
    {
        $user = User::all();
        return view('backend.feature.pesan.index', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
       if(!$request->chat_id == null) {
           $data = $request->except('_token');
           $this->chat->store($data);
       }else{
           $id = Chat::create([]);
           $data = [
               'pesan' => $request->pesan,
               'user_id' => $request->user_id,
               'chat_id' => $id->id
           ];

           $this->chat->store($data);

       }

        return redirect()->back();
    }

    public function distroy($id)
    {
        $this->chats_id->hardDelete($id);

        return redirect()->route('transaction.index')->with('success',__('Pesan berhasil dihapus'));;
    }
}
