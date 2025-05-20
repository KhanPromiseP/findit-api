<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HelpRequest;
use Illuminate\Http\Request;

class AdminHelpRequestController extends Controller
{
    public function index()
    {
        $helpRequests = HelpRequest::with(['user', 'category', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.help-requests.index', compact('helpRequests'));
    }

    public function show(HelpRequest $helpRequest)
    {
        $helpRequest->load(['user', 'category', 'images']);
        
        return view('admin.help-requests.show', compact('helpRequest'));
    }

    public function destroy(HelpRequest $helpRequest)
    {
        // Optional: Delete associated images from storage
        foreach ($helpRequest->images as $image) {
            Storage::delete($image->image_path);
            $image->delete(); // Delete the image record from the database
        }

        $helpRequest->delete();

        return redirect()->route('admin.help-requests.index')
                         ->with('success', 'Help request deleted successfully.');
    }
    
    public function update(Request $request, HelpRequest $helpRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved'
        ]);

        $helpRequest->update($validated);

        // Notify user if status changed to resolved
        if ($validated['status'] === 'resolved') {
            // $this->notifyUserResolved($helpRequest);
        }

        return redirect()->route('admin.help-requests.index')
            ->with('success', 'Help request status updated successfully');
    }

    // protected function notifyUserResolved($helpRequest)
    // {
    //     // Implement your notification logic here
    //     // This could be an email, SMS, or in-app notification
    // }
}