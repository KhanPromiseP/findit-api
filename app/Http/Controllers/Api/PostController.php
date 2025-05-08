<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LostItemPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function post(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'user_id' => ['required'],
            'location' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
            'status' => ['required'],
            'contact' => ['required'],
        ]);

        if ($post = LostItemPost::create($attributes)) {
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'user' => $post
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
