<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    //return Inertia::render('Welcome');
    return inertia('Home');
});

Route::get('/users', function () {
    //sleep(2);
    return inertia('Users/Index', [
        'users' => User::query()
            ->when(Request::input('search'), function ($query, $search) { // $search = Request::input('search')
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate()
            ->withQueryString()
            ->through(fn($user) => [ //with map() we get a new collection, through is almost the same as map, but it's applied to current slice of items
                'id' => $user->id,
                'name' => $user->name
            ]),
        'filters' => Request::only(['search'])
    ]);
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
});

Route::post('/users', function () {
    sleep(3);
    $attributes = Request::validate([
        'name' => 'required',
        'email' => ['required', 'email'],
        'password' => 'required',
    ]);

    User::create($attributes);

    return redirect('/users');
});

Route::get('/settings', function () {
    return inertia('Settings');
});

Route::post('/logout', function () {
    dd(request('foo'));
});
//with map() we get a new collection, through is almost the same as map, but it's applied to current slice of items