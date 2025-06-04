<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $haiku = Http::withToken(config('services.openai.secret'))
        ->post('https://api.openai.com/v1/chat/completions',
            [
                "model"=> "gpt-4o-mini",
                "store"=> true,
                "messages"=> [
                    [
                        "role"=> "user",
                        "content"=> "write a haiku about ai"
                    ]
                ]
            ])->json('choices.0.message.content');
    
    return view('welcome', ['haiku' => $haiku]);
});
