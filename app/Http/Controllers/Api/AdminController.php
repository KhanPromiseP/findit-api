<?php

namespace App\Http\Controllers\Api;

use App\Models\LostItemPost;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'admin']);
    // }

    public function dashboard()
    {
        // Check if the user is authenticated and is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        // auth()->user()->unreadNotifications->markAsRead();

        $pendingPosts = LostItemPost::pending()->with('user')->get();
        $approvedPosts = LostItemPost::approved()->with('user')->get();
        $users = User::where('is_admin', false)->get();

        return view('admin.dashboard', compact('pendingPosts', 'approvedPosts', 'users'));
    }

    /**
     * Display a paginated list of approved lost item posts for admin review.
     * Includes user information for each post. Caches the paginated results.
     *
     * @return View
     */
    public function approvedPosts(): View
    {
        $page = request()->get('page', 1);
        $cacheKey = 'admin.approved_posts.page.' . $page;
        $cacheDuration = now()->addMinutes(5); // Cache for 5 minutes

        $approvedPosts = Cache::remember(
            $cacheKey,
            $cacheDuration,
            function () use ($page) {
                return LostItemPost::approved()
                    ->with(['user:id,name']) 
                    ->latest('approved_at') 
                    ->paginate(15, ['*'], 'page', $page); 
            }
        );

        return view('admin.approved-posts', compact('approvedPosts'));
    }

    /**
     * Approve a specific pending lost item post.
    */
    public function approvePost(Request $request, int $postId): \Illuminate\Http\RedirectResponse
    {
        //Check if the user is authenticated and is an admin (still to be moved to middleware for route)
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $post = LostItemPost::findOrFail($postId);

        $post->update([
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        // Clear the cache for pending and approved posts to reflect the change
        Cache::forget('admin.pending_posts.page.*');
        Cache::forget('admin.approved_posts.page.*');
        
          if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Post approved successfully']);
    }

    return back()->with('success', 'Post approved successfully');

        return back()->with('success', 'Post approved successfully');
    }


   public function deletePost(Request $request, $postId)
{
    // Check if the user is authenticated and is an admin
    if (!Auth::check() || !Auth::user()->is_admin) {
        abort(403, 'Unauthorized action.');
    }

    $post = LostItemPost::findOrFail($postId);
    $post->delete();

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Post deleted successfully']);
    }

    return back()->with('success', 'Post deleted successfully');
}

    public function contactUser(Request $request, $postId)
    {
        // Check if the user is authenticated and is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $post = LostItemPost::findOrFail($postId);
        $whatsappUrl = "https://wa.me/{$post->contact}?text=" . urlencode("Hello, I'm from Findit, contacting you regarding your post: {$post->name}. Description: {$post->description}");

        return redirect($whatsappUrl);
    }



     /**
     * Display pending posts for admin.
     */
    public function pendingPosts(): View
        {
            $page = request()->get('page', 1);
            $cacheKey = 'admin.pending_posts.page.' . $page;
            $cacheDuration = now()->addMinutes(5); // Cache for 5 minutes

            $pendingPosts = Cache::remember(
                $cacheKey,
                $cacheDuration,
                function () use ($page): LengthAwarePaginator {
                    return LostItemPost::pending()
                        ->with(['user:id,name']) 
                        ->latest('created_at')
                        ->paginate(15, ['*'], 'page', $page); // Paginate with explicit page number
                }
            );

            return view('admin.pending-posts', compact('pendingPosts'));
        }

    /**
     * Display a paginated list of registered users for admin management.
     * Includes the ability to delete users. Requires the authenticated user to be an admin.
     * Caches the paginated results.
     *
     * @return View|\Illuminate\Http\RedirectResponse
     */
    public function users(): View|\Illuminate\Http\RedirectResponse
    {
        // Check if the authenticated user is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $page = request()->get('page', 1);
        $cacheKey = 'admin.users.page.' . $page;
        $cacheDuration = now()->addMinutes(5); // Cache for 5 minutes

        $users = Cache::remember(
            $cacheKey,
            $cacheDuration,
            function () use ($page) {
                return User::where('is_admin', false) // Exclude admin users from the list
                    ->latest('created_at')
                    ->paginate(15, ['id', 'name', 'email', 'id_number', 'contact', 'created_at'], 'page', $page);
            }
        );

        return view('admin.users', compact('users'));
    }

    /**
     * Delete a specific user from the system.
     *
     */
    
    public function deleteUser(Request $request, $userId)
    {
        // Check if the user is authenticated and is an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($userId);

        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }















public function payments()
{
    $payments = Invoice::with(['user', 'product'])->latest()->paginate(10);
    $totalPayments = Invoice::sum('amount');
    
    return view('admin.payments', compact('invoices', 'totalPayments'));
}


public function helpRequests()
{
    $helpRequests = HelpRequest::with('user')->latest()->paginate(10);
    $helpRequestsCount = HelpRequest::count();
    
    return view('admin.help-requests.index', compact('helpRequests', 'helpRequestsCount'));
}

// public function foundItems()
// {
//     $foundItems = FoundItem::with('foundBy')->latest()->paginate(10);
//     $foundItemsCount = FoundItem::count();
    
//     return view('admin.found-items', compact('foundItems', 'foundItemsCount'));
// }



public function destroyPayment(Payment $payment)
{
    $payment->delete();
    return back()->with('success', 'Payment record deleted successfully');
}

public function destroyHelpRequest(HelpRequest $helpRequest)
{
    $helpRequest->delete();
    return back()->with('success', 'Help request deleted successfully');
}

public function destroyFoundItem(FoundItem $foundItem)
{
    $foundItem->delete();
    return back()->with('success', 'Found item deleted successfully');
}

}