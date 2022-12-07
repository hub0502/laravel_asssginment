<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http\Models\Chat;

class ChatController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except'=>['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chats = Chats::all();
        return response()->json([
            "status" => "success",
            "chats" => $chats,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $reqeust->validate([
            'chat_content' => "required|string",
            'user_id' => 'required|integer'
        ]);

        $chat = Chat::create([
            'chat_content' => $request->chat_content,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'status' => 'success',
            'chat' => $chat
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $chat = Chat::find($id);
        return response()->json([
            'status' => 'success',
            'chat' => $chat
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'chat_content' => 'required|string'
        ]);

        $chat = chat::find($id);
        $chat->board_id = $request->board_id;
        $chat->chat_content = $reqeust->chat_content;
        $chat->save();

        return response()->json([
            'status' => 'success',
            'message' => 'update chat_content',
            'chat' => $chat
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $chat = Chat::find($id);
        $chat->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'chat deleted successfully',
            'chat' => $chat,
        ]);
    }
}
