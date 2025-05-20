<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Assuming your users are in App\Models\User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersWithContacts(Request $request) // Renamed method for clarity
    {
        $search = $request->query('search');

        $query = User::select('id', 'name', 'contact') // Select 'contact' column
                     ->whereNotNull('contact') // Ensure contact is not null
                     ->where('contact', '!=', ''); // Ensure contact is not empty

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('contact', 'like', '%' . $search . '%'); // Search by 'contact'
            });
        }

        $users = $query->get();

        // Clean phone numbers on the server-side before sending to frontend
        $users->transform(function ($user) {
            $user->contact = preg_replace('/\D/', '', $user->contact); // Clean 'contact'
            return $user;
        });

        return response()->json($users);
    }
}