<?php

namespace App\Http\Controllers\Api;

use App\Models\LostItemPost;
use App\Models\User;
use App\Models\Invoice;
use App\Models\HelpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    public function dashboard()
    {
        // if (!Auth::check() || !Auth::user()->is_admin) {
        //     abort(403, 'Unauthorized action.');
        // }

        $totalPayments = Invoice::sum('amount');
        $helpRequestsCount = HelpRequest::count();
        // $foundItemsCount = FoundItem::count(); 
        $foundItemsCount = Invoice::count(); 

        $pendingPosts = LostItemPost::pending()->with('user')->latest()->take(5)->get();
        $approvedPosts = LostItemPost::approved()->with('user')->latest()->take(5)->get(); 
        $users = User::where('is_admin', false)->latest()->take(5)->get(); 

        return view('admin.dashboard', compact(
            'totalPayments',
            'helpRequestsCount',
            'foundItemsCount',
            'pendingPosts',
            'approvedPosts',
            'users'
        ));
    }

    /**
     * Display a paginated list of approved lost item posts for admin review.
     */
    public function approvedPosts(): View
    {
        $approvedPosts = LostItemPost::approved()
            ->with(['user:id,name']) 
            ->latest('approved_at') 
            ->paginate(15);

        return view('admin.approved-posts', compact('approvedPosts'));
    }

    /**
     * Approve a specific pending lost item post.
     */
    public function approvePost(Request $request, int $postId): \Illuminate\Http\RedirectResponse
    {
        // if (!Auth::check() || !Auth::user()->is_admin) {
        //     abort(403, 'Unauthorized action.');
        // }

        $post = LostItemPost::findOrFail($postId);

        $post->update([
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Post approved successfully']);
        }

        return back()->with('success', 'Post approved successfully');
    }

    public function deletePost(Request $request, $postId)
    {
        // if (!Auth::check() || !Auth::user()->is_admin) {
        //     abort(403, 'Unauthorized action.');
        // }

        $post = LostItemPost::findOrFail($postId);
        $post->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Post deleted successfully']);
        }

        return back()->with('success', 'Post deleted successfully');
    }

    public function contactUser(Request $request, $postId)
    {
        // if (!Auth::check() || !Auth::user()->is_admin) {
        //     abort(403, 'Unauthorized action.');
        // }

        $post = LostItemPost::findOrFail($postId);
        $whatsappUrl = "https://wa.me/{$post->contact}?text=" . urlencode("Hello, I'm from Findit, contacting you regarding your post: {$post->name}. Description: {$post->description}");

        return redirect($whatsappUrl);
    }

    /**
     * Display pending posts for admin.
     */
    public function pendingPosts(): View
    {
        $pendingPosts = LostItemPost::pending()
            ->with(['user:id,name']) 
            ->latest('created_at')
            ->paginate(15);

        return view('admin.pending-posts', compact('pendingPosts'));
    }

    /**
     * Display a paginated list of registered users for admin management.
     */
    public function users(): View|\Illuminate\Http\RedirectResponse
    {
        // if (!Auth::check() || !Auth::user()->is_admin) {
        //     abort(403, 'Unauthorized action.');
        // }

        $users = User::where('is_admin', false)
            ->latest('created_at')
            ->paginate(15, ['id', 'name', 'email', 'id_number', 'contact', 'created_at']);

        return view('admin.users', compact('users'));
    }

    /**
     * Delete a specific user from the system.
     */
    public function deleteUser(Request $request, $userId)
    {
        // if (!Auth::check() || !Auth::user()->is_admin) {
        //     abort(403, 'Unauthorized action.');
        // }

        $user = User::findOrFail($userId);

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
        
        return view('admin.payments', compact('payments', 'totalPayments'));
    }

    public function helpRequests()
    {
        $helpRequests = HelpRequest::with('user')->latest()->paginate(10);
        $helpRequestsCount = HelpRequest::count();
        
        return view('admin.help-requests.index', compact('helpRequests', 'helpRequestsCount'));
    }

    public function foundItems()
    {
        $foundItems = Invoice::with('foundBy')->latest()->paginate(10);
        $foundItemsCount = Invoice::count();
        
        return view('admin.found-items', compact('foundItems', 'foundItemsCount'));
    }

    public function destroyPayment(Invoice $invoice)
    {
        $invoice->delete();
        return back()->with('success', 'Payment record deleted successfully');
    }

    public function destroyHelpRequest(HelpRequest $helpRequest)
    {
        $helpRequest->delete();
        return back()->with('success', 'Help request deleted successfully');
    }

    public function destroyFoundItem(Invoice $foundItem)
    {
        $foundItem->delete();
        return back()->with('success', 'Found item deleted successfully');
    }
}