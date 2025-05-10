<?php


namespace App\Http\Controllers;

use App\Models\LostItemImage;
use App\Models\LostItemPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostApprovalNotification;

class PostController extends Controller
{
    /**
     * Display a listing of the approved posts.
     */
    public function index(Request $request)
    {
        $posts = LostItemPost::query();

        if (!$request->user() || !$request->user()->is_admin) {
            $posts->approved();
        }

        $posts = $posts->with('images')->get();

        return view('posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new post.
     */

       
    public function create()
    {
        // passing categories to views
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

<<<<<<< HEAD
        $post = LostItemPost::create(array_merge(
            Arr::except($attributes, ['image_path']),
            ['is_approved' => false]
        ));
=======
        if ($post = LostItemPost::create(Arr::except($attributes, ['image_path']))) {
>>>>>>> bd9ac265f12cf2edfe3c80c203eec8ffef327092

        if ($post) {
            $images = LostItemImage::create([
                'image_path' => $attributes['image_path'],
                'lost_item_post_id' => $post->id
            ]);

            // Notify admin
            $admin = User::where('is_admin', true)->first();
            if ($admin) {
                $admin->notify(new PostApprovalNotification($post));
            }

            return redirect()->route('posts.index')->with('success', 'Post created successfully and pending approval.');
        }

        return redirect()->back()->withErrors(['error' => 'Failed to create post.']);
    }

<<<<<<< HEAD


  


    /**
     * Display the specified resource.
     */
    public function show(LostItemPost $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LostItemPost $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LostItemPost $post)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'user_id' => ['required'],
            'location' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
            'status' => ['required'],
            'contact' => ['required'],
            'image_path' => ['nullable'] // Make image_path nullable for updates
        ]);

        $post->update(Arr::except($attributes, ['image_path']));

        if ($request->has('image_path')) {
            // Delete existing image if a new one is provided
            if ($post->images()->exists()) {
                $post->images()->delete();
            }
            LostItemImage::create([
                'image_path' => $attributes['image_path'],
                'lost_item_post_id' => $post->id
            ]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LostItemPost $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    /**
     * Search and compare lost items.
     */
=======
  
>>>>>>> bd9ac265f12cf2edfe3c80c203eec8ffef327092
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

        $lostItems = LostItemPost::approved()
            ->when($location, function ($query, $location) {
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
            ->with('images')
            ->get();

        return view('posts.search_results', compact('lostItems'));
    }

<<<<<<< HEAD
    /**
     * Display pending posts for admin.
     */
    public function pendingPosts()
    {
        $posts = LostItemPost::pending()->with(['user', 'images'])->get();

        return view('admin.pending_posts', compact('posts'));
    }

    /**
     * Approve a pending post.
     */
    public function approvePost(LostItemPost $post)
    {
        $post->is_approved = true;
        $post->save();

        return redirect()->route('admin.pending_posts')->with('success', 'Post approved successfully.');
    }

    /**
     * Reject a pending post.
     */
    public function rejectPost(LostItemPost $post)
    {
        $post->delete(); // Or you might want to add a 'rejected' status
        return redirect()->route('admin.pending_posts')->with('success', 'Post rejected successfully.');
    }
}
=======
    

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
>>>>>>> bd9ac265f12cf2edfe3c80c203eec8ffef327092
