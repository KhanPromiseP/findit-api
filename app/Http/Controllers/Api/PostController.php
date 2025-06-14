<?php


namespace App\Http\Controllers\Api;

use App\Models\LostItemImage;
use App\Models\LostItemPost;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostApprovalNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;

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
        $posts = LostItemPost::with(['user', 'LostItemImages'])->paginate(10);
        return view('posts.index', compact('posts'));
        // $posts = $posts->with('images')->get();

        return view('posts.index', compact('posts'));
    }




    public function mine(Request $request)
    {
        try {
            $query = LostItemPost::where('user_id', auth()->id())
                ->with(['user', 'LostItemImages']);

            if (!$request->user()) {
                $query->where('is_approved', true);
            }

            $posts = $query->latest()->paginate(10);

            return view('posts.mine', compact('posts'));
        } catch (\Exception $e) {
            \Log::error('Error in mine(): ' . $e->getMessage());
            abort(500, 'Could not load your posts. Please try again later.');
        }
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'required|array|max:4',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = LostItemPost::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'color' => $validated['color'],
            'location' => $validated['location'],
            'contact' => $validated['contact'],
            'description' => $validated['description'],
            'status' => 'pending',
            'is_approved' => false
        ]);

        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $image) {
                $path = $image->store('lost_item_images', 'public');
                LostItemImage::create([
                    'lost_item_post_id' => $post->id,
                    'image_path' => $path
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'redirect' => route('posts.mine'),
            'message' => 'Item reported successfully! It will be visible after approval.'
        ]);



        // $post = LostItemPost::create(array_merge(
        //     Arr::except($attributes, ['image_path']),
        //     ['is_approved' => false]
        // ));

        //     if ($post = LostItemPost::create(Arr::except($attributes, ['image_path']))) {


        //     if ($post) {
        //         $images = LostItemImage::create([
        //             'image_path' => $attributes['image_path'],
        //             'lost_item_post_id' => $post->id
        //         ]);

        //         // Notify admin
        //         $admin = User::where('is_admin', true)->first();
        //         if ($admin) {
        //             $admin->notify(new PostApprovalNotification($post));
        //         }

        //         return redirect()->route('posts.index')->with('success', 'Post created successfully and pending approval.');
        //     }

        //     return redirect()->back()->withErrors(['error' => 'Failed to create post.']);
        // }


    }




    /**
     * Display the specified resource.
     */
    public function show(LostItemPost $post)
    {
        return view('posts.show', compact('post'));
    }



    public function found(LostItemPost $post)
    {

        $post->load('user', 'LostItemImages', 'category');
        return view('posts.found', compact('post'));
    }


    /**
     * Display the specified search results for the searcher to be able to see the details description for his item.
     */
    public function showsearch(LostItemPost $post)
    {
        return view('find.showsearch', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LostItemPost $post)
    {
        $categories = Category::all();
        $post->load('LostItemImages');
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LostItemPost $post)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:lost,found'],
            'contact' => ['required', 'string', 'max:255'],
            'image_path' => ['sometimes', 'array'],
            'image_path.*' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        // Update post attributes
        $post->update(Arr::except($validated, ['image_path']));

        // Here, we Handle image updates only if images were provided
        if ($request->has('image_path') && is_array($request->image_path)) {
            // Delete existing images
            foreach ($post->LostItemImages as $image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }

            // Store new images
            foreach ($request->image_path as $image) {
                if (is_uploaded_file($image)) {
                    $path = $image->store('lost_item_images', 'public');

                    LostItemImage::create([
                        'lost_item_post_id' => $post->id,
                        'image_path' => $path
                    ]);
                }
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Search and compare lost items.
     */

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
                $query->where(DB::raw('LOWER(location)'), 'like', '%' . strtolower($location) . '%');
            })
            ->when($name, function ($query, $name) {
                $query->where(DB::raw('LOWER(name)'), 'like', '%' . strtolower($name) . '%');
            })
            ->when($category_id, function ($query, $category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($color, function ($query, $color) {
                $query->where(DB::raw('LOWER(color)'), 'like', '%' . strtolower($color) . '%');
            })
            ->with('images', 'category')
            ->get();


        // Fetch all categories from your Category model
        // $categories = \App\Models\Category::all(); 
        $categories = Category::all();

        return view('find.search', compact('lostItems', 'categories'));
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
        // Update status to 'found' when approved
        $post->update([
            'is_approved' => true,
            'status' => 'found', // Add this line to change status
            'approved_at' => now(),
            'approved_by' => auth()->id()
        ]);

        // Optional: Send notification to user
        $post->user->notify(new PostApprovedNotification($post));

        return redirect()->route('admin.pending_posts')
            ->with('success', 'Post approved and status updated successfully');
    }



    /**
     * Reject a pending post.
     */

    public function rejectPost(LostItemPost $post)
    {
        $post->delete(); // Or you might want to add a 'rejected' status
        return redirect()->route('admin.pending_posts')->with('success', 'Post rejected successfully.');
    }


    /**
     * delete image for editing form.
     */

    public function destroyImage(LostItemImage $image)
    {
        try {
            // Verify ownership
            // if (auth()->id() !== $image->lost_item_post_id) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Unauthorized action'
            //     ], 403);
            // }

            // Delete file from storage
            $path = 'public/' . $image->image_path;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }

            // Delete record from database
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error("Image deletion failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }



    public function destroy(LostItemPost $post)
    {
        // Delete associated images first
        foreach ($post->LostItemImages as $image) {
            Storage::delete('public/' . $image->image_path);
            $image->delete();
        }

        // Then delete the post
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
