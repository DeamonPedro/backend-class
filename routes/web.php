<?php

use Illuminate\Http\Request;

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$router->get('/posts', function () {
    return app('db')->table('posts')->get();
});

$router->post('/posts', function (Request $request) {
    $photo = $request->file('photo');
    $fileName = generateRandomString(10);
    $photo->move('uploads', $fileName);
    $photoPath = env('APP_URL') . ':8000/uploads/' . $fileName;
    return app('db')->table('posts')->insert([
        'author' => $request->input('author'),
        'description' => $request->input('description'),
        'createdAt' => date('Y-m-d H:i:s'),
        'photoPath' => $photoPath,
    ]);
});

$router->post('/posts/{id}', function (Request $request, $id) {
    return app('db')->table('posts')->where(['id' => $id])->update([
        'description' => $request->input('description'),
    ]);
});

$router->delete('/posts/{id}', function ($id) {
    return app('db')->table('posts')->where('id', $id)->delete();
});

$router->post('/teste', function (Request $request) {
    $items = $request->input('items');
    return $items;
});
