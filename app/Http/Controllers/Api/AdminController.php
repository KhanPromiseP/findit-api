<?php

namespace App\Http\Controllers;

use App\Models\LostItemPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $pendingPosts = LostItemPost::pending()->with('user')->get();
        $approvedPosts = LostItemPost::approved()->with('user')->get();
        $users = User::where('is_admin', false)->get();

        return view('admin.dashboard', compact('pendingPosts', 'approvedPosts', 'users'));
    }

    public function approvePost(Request $request, $postId)
    {
        $post = LostItemPost::findOrFail($postId);
        
        $post->update([
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => Auth::id()
        ]);

        return back()->with('success', 'Post approved successfully');
    }

    public function rejectPost(Request $request, $postId)
    {
        $post = LostItemPost::findOrFail($postId);
        $post->delete();

        return back()->with('success', 'Post rejected and deleted');
    }

    public function deletePost(Request $request, $postId)
    {
        $post = LostItemPost::findOrFail($postId);
        $post->delete();

        return back()->with('success', 'Post deleted successfully');
    }

    public function contactUser(Request $request, $postId)
    {
        $post = LostItemPost::findOrFail($postId);
        $whatsappUrl = "https://wa.me/{$post->contact}?text=" . urlencode("Hello, I'm from Findit, contacting you regarding your post: {$post->name}. Description: {$post->description}");

        return redirect($whatsappUrl);
    }


    public function dashboard()
    {
        auth()->user()->unreadNotifications->markAsRead();
        
        $pendingPosts = LostItemPost::pending()->with('user')->get();
        $approvedPosts = LostItemPost::approved()->with('user')->get();
        $users = User::where('is_admin', false)->get();

        return view('admin.dashboard', compact('pendingPosts', 'approvedPosts', 'users'));
    }


    public function deleteUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}