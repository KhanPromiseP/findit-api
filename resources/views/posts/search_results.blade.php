<x-app-layout>
     <div class="form-container">
        <h2>Search Lost Items</h2>
        <form id="searchForm" action="{{ route('posts.find') }}" method="GET">
            @csrf
            <input type="text" name="name" placeholder="Item Name" />
            <input type="text" name="color" placeholder="Color" />
            <input type="text" name="location" placeholder="Location" />

            <select name="category_id">
                <option value="" disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Search Results Section -->
    @if(isset($lostItems))
    <div class="search-results">
        <h3>Search Results</h3>
        @if($lostItems->count() > 0)
            <div class="items-grid">
                @foreach($lostItems as $item)
                <div class="item-card">
                    @if($item->images->count() > 0)
                        <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->name }}">
                    @endif
                    <h4>{{ $item->name }}</h4>
                    <p><strong>Color:</strong> {{ $item->color }}</p>
                    <p><strong>Location:</strong> {{ $item->location }}</p>
                    <p><strong>Category:</strong> {{ $item->category->name }}</p>
                    <p><small>Posted {{ $item->created_at->diffForHumans() }}</small></p>
                </div>
                @endforeach
            </div>
        @else
            <p>No items found matching your search criteria.</p>
        @endif
    </div>
    @endif

    <script src="{{ asset('js/search.js') }}"></script>

</x-app-layout>