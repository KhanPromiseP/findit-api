<?php

namespace App\Http\Controllers\Api;

use App\Models\HelpRequest;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class FindController extends Controller
{
    // public function search(Request $request)
    // {
    //     $query = LostItem::with(['category', 'images'])
    //         ->where('status', 'found')
    //         ->orderBy('created_at', 'desc');

    //     if ($request->has('name') && $request->name != '') {
    //         $query->where('name', 'like', '%' . $request->name . '%');
    //     }

    //     if ($request->has('color') && $request->color != '') {
    //         $query->where('color', 'like', '%' . $request->color . '%');
    //     }

    //     if ($request->has('location') && $request->location != '') {
    //         $query->where('location', 'like', '%' . $request->location . '%');
    //     }

    //     if ($request->has('category_id') && $request->category_id != '') {
    //         $query->where('category_id', $request->category_id);
    //     }

    //     $lostItems = $query->get();

    //     $categories = \App\Models\Category::all();

    //     return view('find', [
    //         'lostItems' => $lostItems,
    //         'categories' => $categories
    //     ]);
    // }

    // public function showSearch($id)
    // {
    //     $item = LostItem::with(['category', 'images'])->findOrFail($id);
    //     return view('find-show', compact('item'));
    // }

   public function storeHelpRequest(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'contact' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'date_lost' => 'nullable|date',
            'reward' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072'
        ]);

        $helpRequest = new HelpRequest();
        $helpRequest->user_id = Auth::id();
        $helpRequest->name = $validated['name'];
        $helpRequest->color = $validated['color'];
        $helpRequest->location = $validated['location'];
        $helpRequest->contact = $validated['contact'];
        $helpRequest->category_id = $validated['category_id'];
        $helpRequest->description = $validated['description'];
        $helpRequest->date_lost = $validated['date_lost'];
        $helpRequest->reward = $validated['reward'];
        $helpRequest->status = 'pending';
        $helpRequest->save();

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('help-request-images', 'public');
                $helpRequest->images()->create(['image_path' => $path]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Your help request has been submitted successfully!'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    }


        // Notify admin (you can implement your notification system here)
        // $this->notifyAdmin($helpRequest);

        return response()->json([
            'success' => true,
            'message' => 'Your help request has been submitted successfully!'
        ]);
    }

    // protected function notifyAdmin($helpRequest)
    // {
    //     // Implement your notification logic here
    //     // This could be an email, database notification, etc.
    // }
}