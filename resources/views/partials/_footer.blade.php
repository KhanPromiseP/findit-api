<footer class="buttom-fix mb-2 bg-gray-100 border-t border-gray-200 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Explore</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="{{ route('find.search') }}" class="hover:text-blue-500">Find Lost Items</a></li>
                    <li><a href="{{ route('posts.create') }}" class="hover:text-blue-500">Report a Lost Item</a></li>
                    <li><a href="{{ route('dashboard') }}" class="hover:text-blue-500">Dashboard</a></li>
                    <li><a href="#" class="hover:text-blue-500">Categories</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Information</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="#" class="hover:text-blue-500">About Us</a></li>
                    <li><a href="#" class="hover:text-blue-500">Contact Us</a></li>
                    <li><a href="#" class="hover:text-blue-500">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-blue-500">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Connect</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="#" class="hover:text-blue-500">Facebook</a></li>
                    <li><a href="#" class="hover:text-blue-500">Twitter</a></li>
                    <li><a href="#" class="hover:text-blue-500">Instagram</a></li>
                    <li><a href="#" class="hover:text-blue-500">Email</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Newsletter</h3>
                <p class="text-sm text-gray-600 mb-2">Subscribe to our newsletter to stay updated on new lost items.</p>
                <form>
                    <div class="flex rounded-md shadow-sm">
                        <input type="email" name="email" id="newsletter-email" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-l-md" placeholder="Your email">
                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-r-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-200 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} FindIt. All rights reserved.
        </div>
    </div>
</footer>