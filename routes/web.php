<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

Route::get('/', function () {
    //return Inertia::render('Welcome');
    return inertia('Home');
});

Route::get('/users', function () {
    //sleep(2);
    return inertia('Users', [
        'users' => User::paginate(10)->through(fn($user) => [ //with map() we get a new collection, through is almost the same as map, but it's applied to current slice of items
            'id' => $user->id,
            'name' => $user->name
        ])
    ]);
});

Route::get('/settings', function () {
    return inertia('Settings');
});

Route::post('/logout', function () {
    dd(request('foo'));
});
