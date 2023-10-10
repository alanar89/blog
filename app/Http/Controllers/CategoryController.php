<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Category::paginate(10);
        return view('categorias.index', ['categorias' => $categorias]);
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
            'categoria' => 'required|min:3|unique:categories,name',
        ]);

        $category = new Category();
        $category->name = $request->categoria;
        $category->save();
        return redirect(route('categories.index'))->with("flash", "Tu categoria ha sido creada.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate();

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
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)

    {

        $request->validate([
            'categoria' => 'required|min:3|unique:categories,name',
        ]);

        $category->name = $request->categoria;
        $category->save();
        return redirect(route('categories.index'))->with("flash", "Tu categoria ha sido actualizada.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}