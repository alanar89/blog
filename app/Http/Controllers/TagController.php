<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etiquetas = Tag::paginate(10);
        return view('etiquetas.index', ['etiquetas' => $etiquetas]);
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
            'etiqueta' => 'required|min:3|unique:tags,name',
        ]);

        $tag = new Tag();
        $tag->name = $request->etiqueta;
        $tag->save();
        return redirect(route('tags.index'))->with("flash", "Tu etiqueta ha sido creada.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->paginate();

        $categorias = Category::all();
        $etiquetas = Tag::all()->take(20);
        if (Auth::check()) {
            return view('dashboard', ['posts' => $posts, 'categorias' => $categorias, 'etiquetas' => $etiquetas]);
        } else {
            return view('welcome', ['posts' => $posts, 'categorias' => $categorias, 'etiquetas' => $etiquetas]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'etiqueta' => 'required|min:3|unique:tags,name',
        ]);

        $tag->name = $request->etiqueta;
        $tag->save();
        return redirect(route('tags.index'))->with("flash", "Tu etiqueta ha sido actualizada.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}