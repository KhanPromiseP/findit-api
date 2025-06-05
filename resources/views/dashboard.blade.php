<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FindIt - Reuniting People with Their Lost Items') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-8 px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto text-center mb-12 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-800 mb-6">Lost Something Valuable?</h1>
            <p class="text-xl text-blue-600 mb-8">Our community has helped reunite over 10 items with their owners this year!</p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-6 mb-12">
               <a href="{{ route('posts.create') }}" class="inline-block">
                    <button class="px-8 py-4 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Upload Lost Item
                    </button>
                </a>
                <a href="{{ route('find.search') }}" class="inline-block">
                <button class="px-8 py-4 bg-white hover:bg-blue-100 text-blue-600 font-bold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Find Lost Item
                </button>
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
      <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Items Found Today</p>
                        <p class="text-2xl font-bold text-blue-800">3</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Items Returned</p>
                        <p class="text-2xl font-bold text-blue-800">12</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Active Users</p>
                        <p class="text-2xl font-bold text-blue-800">15</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recently Found Items Carousel -->
        <section class="max-w-7xl mx-auto mb-16">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-blue-800">Recently Found Items</h2>
                <div class="flex space-x-2">
                    <button class="slider-prev p-2 rounded-full bg-white shadow-md hover:bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="slider-next p-2 rounded-full bg-white shadow-md hover:bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="slider-container relative">
                <div class="slider flex gap-6 overflow-x-auto py-4 px-2 scrollbar-hide" id="slider">
                    <!-- Slide Items - Increased to 20 items -->
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/1.jpg" alt="Item 1" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Radio</p>
                            <p class="text-sm text-gray-500">Found 2 hours ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/2.jpg" alt="Item 2" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Head-set</p>
                            <p class="text-sm text-gray-500">Found yesterday</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/3.jpg" alt="Item 3" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Water buttle</p>
                            <p class="text-sm text-gray-500">Found 3 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/21.jpg" alt="Item 4" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Radio</p>
                            <p class="text-sm text-gray-500">Found today</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/5.jpg" alt="Item 5" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Key Holder</p>
                            <p class="text-sm text-gray-500">Found yesterday</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/6.jpg" alt="Item 6" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Iphone</p>
                            <p class="text-sm text-gray-500">Found 5 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="jewelry">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/7.jpg" alt="Item 7" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Ear ring</p>
                            <p class="text-sm text-gray-500">Found 1 week ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/8.jpg" alt="Item 8" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">camera</p>
                            <p class="text-sm text-gray-500">Found 2 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/9.jpg" alt="Item 9" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">hand bag</p>
                            <p class="text-sm text-gray-500">Found yesterday</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/10.jpg" alt="Item 10" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Eye glass</p>
                            <p class="text-sm text-gray-500">Found today</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/11.jpg" alt="Item 11" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">umbreller</p>
                            <p class="text-sm text-gray-500">Found 3 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accesories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/12.jpg" alt="Item 12" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Purse</p>
                            <p class="text-sm text-gray-500">Found 4 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="documents">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/13.jpg" alt="Item 13" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Passport</p>
                            <p class="text-sm text-gray-500">Found 1 day ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/14.jpg" alt="Item 14" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">camera</p>
                            <p class="text-sm text-gray-500">Found 2 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/15.jpg" alt="Item 15" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">nokia phone</p>
                            <p class="text-sm text-gray-500">Found 1 week ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="electronics">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/16.jpg" alt="Item 16" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">laptop</p>
                            <p class="text-sm text-gray-500">Found today</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="pets">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/17.jpg" alt="Item 17" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Cap</p>
                            <p class="text-sm text-gray-500">Found 3 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/18.jpg" alt="Item 18" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">Bag</p>
                            <p class="text-sm text-gray-500">Found yesterday</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/19.jpg" alt="Item 19" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">purse</p>
                            <p class="text-sm text-gray-500">Found 4 days ago</p>
                        </div>
                    </div>
                    
                    <div class="slide min-w-[250px] bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-category="accessories">
                        <div class="h-40 bg-blue-100 flex items-center justify-center">
                            <img src="pic/20.jpg" alt="Item 20" class="max-h-full max-w-full object-contain" />
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-blue-800">shoe</p>
                            <p class="text-sm text-gray-500">Found today</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Carousel -->
        <section class="max-w-7xl mx-auto mb-16">
            <h3 class="text-2xl font-bold text-blue-800 mb-6">Browse by Categories</h3>
            
            <div class="relative">
                <div class="flex space-x-2 mb-4 justify-end">
                    <button class="categories-prev p-2 rounded-full bg-white shadow-md hover:bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="categories-next p-2 rounded-full bg-white shadow-md hover:bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                
                <div class="categories-slider-container overflow-hidden">
                    <div class="categories-slider flex gap-4 overflow-x-auto py-2 scrollbar-hide" id="categories-slider">
                        <!-- All Categories Button -->
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="all">
                            <div class="p-3 rounded-full bg-white bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span>All Items</span>
                        </button>
                        
                        <!-- Other Categories -->
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="electronics">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Electronics</span>
                        </button>
                        
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="documents">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Documents</span>
                        </button>
                        
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="accessories">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2m5-11a2 2 0 00-2-2h-2a2 2 0 00-2 2v2h4V6zm0 12a2 2 0 002-2v-2h-4v2a2 2 0 002 2zm-12 0a2 2 0 01-2-2v-2h4v2a2 2 0 01-2 2zM7 9H5a2 2 0 00-2 2v2h4v-2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Accessories</span>
                        </button>
                        
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="pets">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Pets</span>
                        </button>
                        
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="jewelry">
                            <div class="p-3 rounded-full bg-pink-100 text-pink-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Jewelry</span>
                        </button>
                        
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="clothing">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Clothing</span>
                        </button>
                        
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="bags">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Bags</span>
                        </button>
                        
                        <button class="category-btn flex-shrink-0 px-6 py-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex flex-col items-center justify-center gap-2 min-w-[150px]" data-category="vehicles">
                            <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <span class="font-medium text-blue-800">Vehicles</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Stories -->
        <section class="max-w-7xl mx-auto mb-16">
            <h3 class="text-2xl font-bold text-blue-800 mb-6">Success Stories</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start mb-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-blue-800">Sarah's Lost Wedding Ring</h4>
                            <p class="text-sm text-gray-500">Reunited after 3 days</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"I thought I'd never see my grandmother's wedding ring again after losing it at the park. Thanks to FindIt, a kind stranger found it and I got it back the next day!"</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start mb-4">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-blue-800">Michael's Missing Dog</h4>
                            <p class="text-sm text-gray-500">Reunited after 1 week</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"My dog Max ran away during a storm. I posted on FindIt and within hours, people were messaging me with sightings. A family 2 miles away had taken him in!"</p>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="max-w-7xl mx-auto mb-16">
            <h3 class="text-2xl font-bold text-blue-800 mb-8 text-center">How FindIt Works</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-800">1</span>
                    </div>
                    <h4 class="font-bold text-blue-800 mb-2">Report Lost Item</h4>
                    <p class="text-gray-600">Create a post with details about what you lost and where.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-800">2</span>
                    </div>
                    <h4 class="font-bold text-blue-800 mb-2">Community Alerts</h4>
                    <p class="text-gray-600">Our system notifies users in the area to look out for your item.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-800">3</span>
                    </div>
                    <h4 class="font-bold text-blue-800 mb-2">Get Matched</h4>
                    <p class="text-gray-600">When someone finds your item, we connect you to arrange return.</p>
                </div>

                 <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-800">4</span>
                    </div>
                    <h4 class="font-bold text-blue-800 mb-2">Findit Help</h4>
                    <p class="text-gray-600">Findit team help you found your item if it is not yet on the patform!.</p>
                </div>
            </div>
        </section>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>

    <script>
        // Enhanced slider functionality
        const slider = document.getElementById('slider');
        const slides = Array.from(document.querySelectorAll('.slide'));
        const prevBtn = document.querySelector('.slider-prev');
        const nextBtn = document.querySelector('.slider-next');
        
        let currentIndex = 0;
        const slideWidth = 250 + 24; // width + gap
        
        // Auto-scroll slider with pause on hover
        let autoScroll = setInterval(() => {
            scrollToNext();
        }, 3000);
        
        slider.addEventListener('mouseenter', () => {
            clearInterval(autoScroll);
        });
        
        slider.addEventListener('mouseleave', () => {
            autoScroll = setInterval(() => {
                scrollToNext();
            }, 3000);
        });
        
        function scrollToNext() {
            currentIndex = (currentIndex + 1) % slides.length;
            slider.scrollTo({
                left: currentIndex * slideWidth,
                behavior: 'smooth'
            });
        }
        
        function scrollToPrev() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            slider.scrollTo({
                left: currentIndex * slideWidth,
                behavior: 'smooth'
            });
        }
        
        nextBtn.addEventListener('click', scrollToNext);
        prevBtn.addEventListener('click', scrollToPrev);
        
        // Categories Carousel
        const categoriesSlider = document.getElementById('categories-slider');
        const categoriesPrevBtn = document.querySelector('.categories-prev');
        const categoriesNextBtn = document.querySelector('.categories-next');
        const categoryButtons = document.querySelectorAll('.category-btn');
        
        let categoriesCurrentIndex = 0;
        const categoryWidth = 150 + 16; // width + gap
        
        categoriesNextBtn.addEventListener('click', () => {
            categoriesCurrentIndex = Math.min(
                categoriesCurrentIndex + 1,
                categoriesSlider.children.length - Math.floor(categoriesSlider.clientWidth / categoryWidth)
            );
            categoriesSlider.scrollTo({
                left: categoriesCurrentIndex * categoryWidth,
                behavior: 'smooth'
            });
        });
        
        categoriesPrevBtn.addEventListener('click', () => {
            categoriesCurrentIndex = Math.max(categoriesCurrentIndex - 1, 0);
            categoriesSlider.scrollTo({
                left: categoriesCurrentIndex * categoryWidth,
                behavior: 'smooth'
            });
        });
        
        // Category filter functionality
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                categoryButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-white', 'text-blue-800');
                });
                
                // Add active class to clicked button
                this.classList.remove('bg-white', 'text-blue-800');
                this.classList.add('bg-blue-600', 'text-white');
                
                const category = this.getAttribute('data-category');
                slides.forEach(slide => {
                    const tags = slide.getAttribute('data-category');
                    if (category === 'all' || (tags && tags.includes(category))) {
                        slide.style.display = 'block';
                    } else {
                        slide.style.display = 'none';
                    }
                });
            });
        });
        
        // Set 'All' as default active category
        document.querySelector('[data-category="all"]').classList.add('bg-blue-600', 'text-white');
        document.querySelector('[data-category="all"]').classList.remove('bg-white', 'text-blue-800');
        
        // Animate elements on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.slide, .category-btn, [class*="grid-cols-"] > div');
            
            elements.forEach((element, index) => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (elementPosition < screenPosition) {
                    element.classList.add('animate-fade-in');
                    element.style.animationDelay = `${index * 0.1}s`;
                }
            });
        };
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</x-app-layout>