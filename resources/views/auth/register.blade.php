<x-guest-layout>
    <div class="">
        <!-- Logo Container -->
        <!-- <div class="flex justify-center mb-8">
            <div class="bg-white p-3 rounded-full shadow-lg border-4 border-blue-100">
                <img src="{{ asset('images/logo.png') }}" alt="FindIt Logo" class="h-16 w-16">
            </div>
           
        </div> -->

        <!-- Card Container -->
        <div class="">
            <!-- Card Header -->
             <div class="bg-blue-100 py-1 px-6">
                <h2 class="text-center text-4xl font-bold text-blue">Create Account</h2>
                <p class="text-center text-blue-900 text-sm mt-2">Join FindIt to report and find lost items</p>
            </div>

            <!-- Card Body -->
            <div class="px-4">
                <form class="space-y-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 ">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input id="name" name="name" type="text" required autocomplete="name" autofocus
                                   class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                                   placeholder="Your full name"
                                   value="{{ old('name') }}">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required autocomplete="email"
                                   class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                                   placeholder="your@email.com"
                                   value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required autocomplete="new-password"
                                   class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                   class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- ID Number Field -->
                    <div>
                        <label for="id_number" class="block text-sm font-medium text-gray-700 mb-1">ID Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <input id="id_number" name="id_number" type="text" required
                                   class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                                   placeholder="Your ID number"
                                   value="{{ old('id_number') }}">
                        </div>
                        <x-input-error :messages="$errors->get('id_number')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Contact Field -->
                    <div>
                        <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <input id="contact" name="contact" type="text" required
                                   class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200"
                                   placeholder="Your phone number"
                                   value="{{ old('contact') }}">
                        </div>
                        <x-input-error :messages="$errors->get('contact')" class="mt-1 text-sm text-red-600" />
                    </div>
                    <!-- Profile Picture Upload Field -->
                    <div>
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                        <div class="relative">
                            <input id="profile_picture" name="profile_picture" type="file"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200">
                        </div>
                        <x-input-error :messages="$errors->get('profile_picture')" class="mt-1 text-sm text-red-600" />
                        <p class="text-sm text-gray">optional (can set on your profile page after)</p>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            Create Account
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="mt-5 text-center">
                        <p class="text-sm text-gray-600 mb-4">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>