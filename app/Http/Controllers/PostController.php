<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where("active", 1)->orderByDesc('published_at')->paginate(10);
        $categorias = Category::all();
        $etiquetas = Tag::all()->take(20);
        if (Auth::check()) {
            return view('dashboard', ['posts' => $posts, 'categorias' => $categorias, 'etiquetas' => $etiquetas]);
        } else {
            return view('welcome', ['posts' => $posts, 'categorias' => $categorias, 'etiquetas' => $etiquetas]);
        }
    }

    public function dashboard()
    {
        if (Auth::user()->rol == "admin") {
            $posts = Post::orderByDesc('published_at')->paginate(10);
        } else {
            $posts = Post::where("user_id", Auth::id())->orderByDesc('published_at')->paginate(10);
        }

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::all();
        $tags = Tag::all();
        return view('posts.create', ['categorias' => $categorias, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'titulo' => 'required|min:3|max:255',
            'editor' => 'required',
            'foto' => 'required|image|max:2048',
            'categoria' => 'required',
            'extracto' => 'required',
            'estado' => 'required|numeric'

        ]);

        $post = new Post();
        $post->title = $request->titulo;
        $post->body = $request->editor;
        $post->published_at = Carbon::parse($request->fecha);
        $post->category_id = $request->categoria;
        $post->exerpt = $request->extracto;
        $post->active = $request->estado;
        $post->user_id = auth()->id();
        if ($request->hasFile("foto")) {
            $foto = $request->file("foto");
            $nombre = $foto->hashName();
            $request->file("foto")->storeAs("public/images", $nombre);
            // $ruta = public_path("images");
            // $foto->move($ruta, $nombre);
            $post->photo =  $nombre;
        }
        $post->save();
        $post->tags()->attach($request->etiquetas);
        return redirect(route('posts.index'))->with("flash", "Tu publicacíon ha sido creada.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categorias = Category::all();
        $tags = Tag::all();
        $posts = Post::all()->where('user_id', $post->user->id);
        return view('posts.show', ['posts' => $posts, 'post' => $post, 'categorias' => $categorias, 'etiquetas' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categorias = Category::all();
        $tags = Tag::all();
        return view('posts.edit', ['post' => $post, 'categorias' => $categorias, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'titulo' => 'required|min:3|max:255',
            'editor' => 'required',
            'categoria' => 'required',
            'extracto' => 'required',
            'estado' => 'required|numeric'

        ]);


        $post->title = $request->titulo;
        $post->body = $request->editor;
        $post->published_at = Carbon::parse($request->fecha);
        $post->category_id = $request->categoria;
        $post->active = $request->estado;
        if ($request->hasFile("foto")) {
            Storage::delete('public/images/' . $post->photo);
            $nombre =  $request->file("foto")->hashName();
            $request->file("foto")->storeAs("public/images", $nombre);
            $post->photo =  $nombre;
        }
        $post->exerpt = $request->extracto;
        $post->save();
        $post->tags()->sync($request->etiquetas);
        return redirect(route('posts.index'))->with("flash", "Tu publicacíon ha sido actualizada.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $post->tags()->detach($post->etiquetas);

        Storage::delete('public/images/' . $post->photo);
        return redirect(route('posts.index'))->with("flash", "Tu publicacíon ha sido eliminada.");
    }
}