<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;

class BoardController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index(){
        $boards = Board::all();
        return response()->json([
            'status' => 'success',
            'boards' => $boards,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'token' => 'required|string'
        ]);

        $user = Auth::authenticate($request->token);


        $board = Board::create([
            'title' => $request->title,
            'content' => $request->content,
            'userId' => $user->id,
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Todo created successfully',
            'board' => $board,
        ]);
    }

    public function show($id){
        $board = Board::find($id);
        return response()->json([
            'status' => 'success',
            'board' => $board,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ]); 

        $board = Board::find($id);
        $board->title = $request->title;
        $board->content = $request->content;
        $board->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Board updated successfully',
            'board' => $board,
        ]);
    }

    public function destroy($id){
        $board = Board::find($id);
        $board->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Board deleted successfully',
            'board' => $board,
        ]);
    }
}
