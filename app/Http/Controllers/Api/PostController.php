<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LostItemImage;
use App\Models\LostItemPost;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
            'image_path' => ['required']
            // php artisan breeze:install
        ]);

        // $post_id = LostItemPost::latest()->first()->id;
        if ($post = LostItemPost::create(Arr::except($attributes, ['image_path']))) {

            if ($images = LostItemImage::create([
                'image_path' => $attributes['image_path'],
                'lost_item_post_id' => LostItemPost::latest()->first()->id
            ])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Post created successfully with image',
                    'user' => $post,
                    'images' => $images
                ]);
            }
            return response()->json([
                'status' => 'failure',
                'message' => 'Post created successfully but image not inserted',
                'user' => $post,
                'post_id' => LostItemPost::latest()->first()->id
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    /**
     * Display the specified resource.
     */
    public function find(Request $request)
    {
        $attributes = $request->validate([
            "color" => "string|nullable",
            "category_id" => "string|nullable",
            "name" => "string|nullable",
            "location" => "string|nullable"
        ]);

        // $location = $attributes["location"];
        // $color = $attributes["color"];
        // $category_id = $attributes["category_id"];
        // $name = $attributes["name"];

        $location = $attributes['location'] ?? null;
        $name = $attributes['name'] ?? null;
        $category_id = $attributes['category_id'] ?? null;
        $color = $attributes['color'] ?? null;

        $lostItems = LostItemPost::when($location, function ($query, $location) {
            $query->where('location', 'like', '%' . $location . '%');
        })
        ->when($name, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        })
        ->when($category_id, function ($query, $category_id) {
            $query->where('category_id', $category_id);
        })
        ->when($color, function ($query, $color) {
            $query->where('color', 'like', '%' . $color . '%');
        })
        ->get();


        return response()->json([
            'status' => 'success',
            'data' => $lostItems
        ], 201);
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
