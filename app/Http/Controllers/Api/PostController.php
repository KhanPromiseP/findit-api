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
            'color' => ['required'],
            'category_id' => ['required'],
            'status' => ['required'],
            'contact' => ['required'],
            'image_path' => ['required']
        ]);

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

  
    public function find(Request $request)
    {
        $attributes = $request->validate([
            "color" => "string|nullable",
            "category_id" => "integer|nullable",
            "name" => "string|nullable",
            "location" => "string|nullable"
        ]);

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

    

     //non resful : using POST

    // public function destroy(Request $request)
    // {
    //     $post_id = $request->validate(['post_id' => ["required"]]);
    //     if ($post = LostItemPost::find($post_id['post_id'])) { //use findOrFail on frontend not api as it auto sets an abort page
    //         $post->delete();
    //         return response()->json([
    //             'status' => 'successful deletion',
    //         ], 201);           
    //     }
    //     return response()->json([
    //         'message' => 'Invalid credentials/post absent'
    //     ]);
        
        
    // }

    public function destroy(LostItemPost $post)
    {
        if ($post) { 
            $post->delete();
            return response()->json([
                'status' => 'successful deletion',
            ], 201);           
        }
        return response()->json([
            'message' => 'Invalid credentials/post absent'
        ]);
        
        
    }
    public function update(Request $request, LostItemPost $post)
{
    $attributes = $request->validate([
        'name' => ['required', 'string'],
        'location' => ['required', 'string'],
        'color' => ['required'],
        'description' => ['required', 'string'],
        'category_id' => ['required', 'integer'],
        'status' => ['required', 'string'],
        'contact' => ['required', 'string'],
        'image_path' => ['required', 'string']
    ]);


    if ($post) {
        $update_post = $post->update(Arr::except($attributes, ['image_path']));

        $image = LostItemImage::where('lost_item_post_id', $post->id)->first();

        if ($image) {
            $update_images = $image->update(['image_path' => $attributes['image_path']]);
        } else {
            $update_images = LostItemImage::create([
                'image_path' => $attributes['image_path'],
                'lost_item_post_id' => $post->id
            ]);
        }

        if ($update_post) {
            return response()->json([
                'status' => 'success',
                'message' => 'Post successfully edited',
                'post' => $post,
                'images' => $update_images ?? $image
            ]);
        }
    }

    return response()->json([
        'message' => 'Invalid credentials'
    ], 401);
}
}
