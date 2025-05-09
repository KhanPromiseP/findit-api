@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>


<!-- notification dropdown -->
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="notificationsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Notifications <span class="badge badge-light">{{ auth()->user()->unreadNotifications->count() }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown">
        @foreach(auth()->user()->unreadNotifications as $notification)
            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                {{ $notification->data['message'] }}
            </a>
        @endforeach
        @if(auth()->user()->unreadNotifications->isEmpty())
            <span class="dropdown-item">No new notifications</span>
        @endif
    </div>
</div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    Pending Posts ({{ $pendingPosts->count() }})
                </div>
                <div class="card-body">
                    @if($pendingPosts->isEmpty())
                        <p>No pending posts</p>
                    @else
                        <div class="table-responsive">
                           <!-- Users Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Posts Count</th>
                                        <th>Registered At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->lostItemPosts->count() }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                onclick="if(confirm('Are you sure?')) { document.getElementById('delete-user-{{ $user->id }}').submit(); }">
                                                Delete
                                            </button>
                                            <form id="delete-user-{{ $user->id }}" action="{{ route('admin.users.delete', $user) }}" method="POST" class="d-none">
                                                @csrf @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pending Posts Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Contact</th>
                                        <th>Posted At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingPosts as $post)
                                    <tr>
                                        <td>{{ $post->name }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.contact.user', $post) }}" class="text-primary" target="_blank">
                                                {{ $post->contact }}
                                            </a>
                                        </td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" 
                                                onclick="document.getElementById('approve-post-{{ $post->id }}').submit()">
                                                Approve
                                            </button>
                                            <form id="approve-post-{{ $post->id }}" action="{{ route('admin.posts.approve', $post) }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                            
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                onclick="if(confirm('Are you sure?')) { document.getElementById('reject-post-{{ $post->id }}').submit(); }">
                                                Reject
                                            </button>
                                            <form id="reject-post-{{ $post->id }}" action="{{ route('admin.posts.reject', $post) }}" method="POST" class="d-none">
                                                @csrf @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    Approved Posts ({{ $approvedPosts->count() }})
                </div>
                <div class="card-body">
                    @if($approvedPosts->isEmpty())
                        <p>No approved posts</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Contact</th>
                                        <th>Approved At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($approvedPosts as $post)
                                    <tr>
                                        <td>{{ $post->name }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.contact.user', $post) }}" target="_blank">
                                                {{ $post->contact }}
                                            </a>
                                        </td>
                                        <td>{{ $post->approved_at->diffForHumans() }}</td>
                                        <td>
                                            <form action="{{ route('admin.posts.delete', $post) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    Users ({{ $users->count() }})
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Posts Count</th>
                                    <th>Registered At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->lostItemPosts->count() }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection