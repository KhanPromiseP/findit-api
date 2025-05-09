<x-app-layout>

<div class="form-container">
        <h2>Report Found Item</h2>
        <form id="foundItemForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="status" value="found">

            <input type="text" name="name" placeholder="Object Name" required />
            <input type="text" name="color" placeholder="Color" required />
            <input type="text" name="location" placeholder="Location Found" required />
            <input type="text" name="contact" placeholder="Your Contact Number" required />
            
            <textarea name="description" placeholder="Detailed description of the item" required></textarea>

            <select name="category_id" required>
                <option value="" disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <label for="image_path">Upload Images (max 3)</label>
            <input type="file" id="image_path" name="image_path[]" accept="image/*" multiple required />
            <div class="preview" id="preview"></div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="{{ asset('js/found.js') }}"></script>
    <script>
        document.getElementById('foundItemForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.href = "{{ route('posts.index') }}";
                } else {
                    alert('Error: ' + (data.message || 'Failed to submit form'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });

        // Image preview functionality
        document.getElementById('image_path').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            
            if(this.files) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100px';
                        img.style.maxHeight = '100px';
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
    
<x-app-layout>