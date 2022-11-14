<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

function authorization_exception(string $message): Response|Application|ResponseFactory
{
    return response([
        "error" => $message
    ], 403);
}

function model_not_found_exception(string $message): Response|Application|ResponseFactory
{
    return response([
        "error" => $message
    ], 404);
}

function not_found_http_exception(string $message): Response|Application|ResponseFactory
{
    return response([
        "error" => $message
    ], 404);
}
