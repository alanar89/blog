<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string|min:10|max:255',
            'nombre' => 'required|string|min:3|max:50',
            'email' => 'required|string|email',
        ]);
        $mensaje = new Comment();
        $mensaje->name = $request->nombre;
        $mensaje->comment = $request->mensaje;
        $mensaje->email = $request->email;
        $mensaje->post_id = $request->post;
        $mensaje->save();
        return back()->with("flash", "Gracias por comentar.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $comments = Comment::where('post_id', $request->id)->orderByDesc('created_at')->paginate();
        $post = Post::find($request->id);
        return view("comentarios.show", ["post" => $post, "comments" => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with("flash", "Comentario eliminado con exito.");
    }
}