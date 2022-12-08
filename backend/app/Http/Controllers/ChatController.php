<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except'=>['index', 'show', 'destroy']]);
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
        $request->validate([
            'chat_content' => 'required|string',
            'board_id' => 'required|integer',
            'token' => 'required|string'
        ]);
        
        $user = Auth::authenticate($request->token);

        $chat = Chat::create([
            'chat_content' => $request->chat_content,
            'user_id' => $user->id,
            'board_id' => $request->board_id
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
    public function show($board_id)
    {
        //
        $chat = Chat::all()->where('board_id', $board_id);
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
    public function destroy($id, Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        //
        $chat = Chat::all()->where('id', '=', $id)->first();
        $user = Auth::authenticate($request->token);
        if($user->id == $chat->user_id){
            DB::table('chats')->where('id', '=', $id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'chat deleted successfully',
                'chat' => $chat,
            ]);
        } else{
            return response()->json([
                'status' => 'not access user'
            ]);
        }
        
        
    }
}
