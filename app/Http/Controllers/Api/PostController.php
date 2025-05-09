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
            'category_id' => ['required'],
            'status' => ['required'],
            'contact' => ['required'],
            'image_path' => ['required']
        ]);

        $post = LostItemPost::create(array_merge(
            Arr::except($attributes, ['image_path']),
            ['is_approved' => false]
        ));

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
    public function find(Request $request)
    {
        $attributes = $request->validate([
            "color" => "string|nullable",
            "category_id" => "string|nullable",
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