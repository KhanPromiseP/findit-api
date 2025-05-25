<x-app-layout>
   

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto text-center mb-12 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-800 mb-6">We're Here to Help</h1>
            <p class="text-xl text-blue-600 mb-8">Have questions about a found item? Need assistance with your account? Reach out anytime!</p>
            
            <div class="bg-white rounded-2xl shadow-xl p-1 inline-block">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-8 text-white">
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div class="text-left">
                                <p class="text-sm font-medium">Email us at</p>
                                <p class="text-xl font-bold">support@findit.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div class="text-left">
                                <p class="text-sm font-medium">Call us at</p>
                                <p class="text-xl font-bold">+(237) 680834767</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Cards -->
        <div class="max-w-7xl mx-auto  md:grid-cols-2 gap-8 mb-12">
            <!-- Contact Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.01] transition-all duration-300">
                <div class="bg-blue-600 p-6 text-white">
                    <h3 class="text-2xl font-bold flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Send Us a Message
                    </h3>
                </div>
                <div class="p-6">
                    <form id="contactForm" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                            <input type="text" id="name" name="name" required 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <select id="subject" name="subject" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Select a topic</option>
                                <option value="lost_item">About a Lost Item</option>
                                <option value="found_item">About a Found Item</option>
                                <option value="account">Account Support</option>
                                <option value="feedback">Feedback/Suggestions</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                            <textarea id="message" name="message" rows="5" required 
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="consent" name="consent" required 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="consent" class="ml-2 block text-sm text-gray-700">
                                I agree to the <a href="#" class="text-blue-600 hover:underline">privacy policy</a>
                            </label>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
            
         
        </div>

        <!-- FAQ Section -->
        <div class="max-w-7xl mx-auto mb-16">
            <h3 class="text-2xl font-bold text-blue-800 mb-8 text-center">Frequently Asked Questions</h3>
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <!-- FAQ Item 1 -->
                    <div class="p-6">
                        <button class="faq-toggle w-full flex justify-between items-center text-left">
                            <h4 class="text-lg font-bold text-blue-800">How do I report a found item?</h4>
                            <svg class="h-5 w-5 text-blue-600 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 hidden">
                            <p>To report a found item, click on "Upload Found Item" in the navigation menu or on the homepage. Fill out the form with as much detail as possible about where and when you found the item, and upload clear photos if available. This helps the rightful owner identify their lost property.</p>
                        </div>
                    </div>
                    
                    <!-- FAQ Item 2 -->
                    <div class="p-6">
                        <button class="faq-toggle w-full flex justify-between items-center text-left">
                            <h4 class="text-lg font-bold text-blue-800">What should I do if I find my lost item on your site?</h4>
                            <svg class="h-5 w-5 text-blue-600 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 hidden">
                            <p>If you see your lost item listed on our site, click the "Claim This Item" button on the item's page. You'll need to provide proof of ownership, which may include describing unique identifying features or providing documentation. Once verified, we'll connect you with the finder to arrange return of your item.</p>
                        </div>
                    </div>
                    
                 
                    
                    <!-- FAQ Item 3 -->
                    <div class="p-6">
                        <button class="faq-toggle w-full flex justify-between items-center text-left">
                            <h4 class="text-lg font-bold text-blue-800">Is there a fee to use FindIt services?</h4>
                            <svg class="h-5 w-5 text-blue-600 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 hidden">
                            <p>The answer is YES. Findit is a free services platform that help anyone to get back their lost item! NB: Some small fee might apply at the level of connecting you to your loat item..</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .faq-content.show {
            display: block;
        }
    </style>

    <script>
        // FAQ Toggle Functionality
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('svg');
                
                // Toggle the content
                content.classList.toggle('hidden');
                content.classList.toggle('show');
                
                // Rotate the icon
                icon.classList.toggle('rotate-180');
                
                // Close other open FAQs
                document.querySelectorAll('.faq-toggle').forEach(otherButton => {
                    if (otherButton !== button) {
                        otherButton.nextElementSibling.classList.add('hidden');
                        otherButton.nextElementSibling.classList.remove('show');
                        otherButton.querySelector('svg').classList.remove('rotate-180');
                    }
                });
            });
        });
        
        // Form Submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate form submission
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sending...
            `;
            
            // Simulate API call
            setTimeout(() => {
                submitBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Message Sent!
                `;
                submitBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                submitBtn.classList.add('bg-green-600', 'hover:bg-green-700');
                
                // Reset form after 3 seconds
                setTimeout(() => {
                    this.reset();
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Send Message
                    `;
                    submitBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
                    submitBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
                }, 3000);
            }, 1500);
        });
        
        // Animate elements on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.bg-white, [class*="grid-cols-"] > div');
            
            elements.forEach((element, index) => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (elementPosition < screenPosition) {
                    element.classList.add('animate-fade-in');
                    element.style.animationDelay = `${index * 0.1}s`;
                }
            });
        };
        
        // window.addEventListener('scroll', animateOnScroll);
        // window.addEventListener('load', animateOnScroll);
    </script>
</x-app-layout>