<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        $posts = $user->posts()->paginate();

        $categorias = Category::all();
        $etiquetas = Tag::all()->take(20);
        if (Auth::check()) {
            return view('dashboard', ['posts' => $posts, 'categorias' => $categorias, 'etiquetas' => $etiquetas]);
        } else {
            return view('welcome', ['posts' => $posts, 'categorias' => $categorias, 'etiquetas' => $etiquetas]);
        }
    }

    public function store(Request $request)

    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->active = 1;
        $user->rol = $request->rol;
        $user->save();

        return redirect(route('users.index'))->with("flash", " Nuevo usuario registrado.");
    }

    public function update(Request $request, User $user)

    {
        $user->active = $request->estado;
        $user->rol = $request->rol;
        $user->save();

        return redirect(route('users.index'))->with("flash", "Usuario actualizado.");
    }
}