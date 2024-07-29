<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Listar todos os produtos cadastrados.
Route::get('/products', [ProductController::class, 'index']);
// Cadastrar produtos.
Route::post('/products', [ProductController::class, 'store']);
// Cadastrar Categorias.
Route::post('/categories', [CategoryController::class, 'store']);
// Alterar produtos cadastrados.
Route::put('/products/{id}', [ProductController::class, 'update']);
// Deletar produtos cadastrados.
Route::delete('/products/{id}', [ProductController::class, 'destroy']);


// Sistema de auth

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api');