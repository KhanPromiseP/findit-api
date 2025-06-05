<x-app-layout>
    {{-- Optional: If you want a header specific to About Us in your default layout --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

 
    <section class="banner">
        <div class="hero">
            <div class="images">
                <div class="left_image">
                      <img src="{{ asset('pic/1.jpg') }}" alt="found objects">
                  <p>. </p>
                </div>
                <div class="right_image">

                    <img src="{{ asset('pic/2.jpg') }}" alt="found objects">
                    <img src="{{ asset('pic/3.jpg') }}" alt="found objects">

                    <div class="img-up"> <p>.</p></div>
                    <div class="img-down"> <p>.</p></div>
                </div>
            </div>  
            <div class=" mb-5 flex py-6 info">
                <p class="top">We are the top Listing website for lost and found items where 1K+ users trust us.</p>
                <p class="mid">we curate potential reunions,holding echoes of past moments until they can 
                resonate with their rightful owners once more.</p>
                <div class="mb-3" ><button > <a href="{{ route('contact.show') }}">Contact Us</a></button>  </div>
                
                <button ><a  class="mt-3 flex py-6" href="{{ route('dashboard') }}">Dashboard</a></button> 

            </div> 
        </div>
        <div class="stats">
            <div class="sum-fig">
                <p class="numb">18</p>
                <p><span>Items Added</span></p>
            </div>
            <div class="sum-fig">
                <p class="numb">12</p>
                <p><span>Registered Users</span></p>
            </div>
            <div class="sum-fig">
                <p class ="numb">1</p>
                <p><span>Towns Available</span></p>
            </div>
            <div class="sum-fig">
                <p class="numb">5</p>
                <p><span>Daily Visitors</span></p>
            </div>
            
        </div>
        <div class="team">
            <h1>Team Of Experts</h1>
            <p> we strive to proide the best service</p>
            <div class="members">
                <div class="team-member">
                    <div class="image-div">
                        <img src="{{ asset('we/favor.jpeg') }}" alt="image">

                        </div>
                    <div class="sm-icons">
                       <img src="{{ asset('icons/fby.png') }}" alt="facebook"> {{-- Use asset() --}}
                       <img src="{{ asset('icons/ig.png') }}" alt="image">   {{-- Use asset() --}}
                       <img src="{{ asset('icons/in.png') }}" alt="image">   {{-- Use asset() --}}
                       <img src="{{ asset('icons/xt.png') }}" alt="image">   {{-- Use asset() --}}
                    </div> 
                    <p class="m-name">Ndi Favour</p>
                    <p class="m-role">Developer</p>
                </div>
                <div class="team-member">
                    <div class="image-div">
                        <img src="{{ asset('we/harisson.jpeg') }}" alt="image">
                        </div>
                    <div class="sm-icons">
                       <img src="{{ asset('icons/fby.png') }}" alt="facebook">
                       <img src="{{ asset('icons/ig.png') }}" alt="image">
                       <img src="{{ asset('icons/in.png') }}" alt="image">
                       <img src="{{ asset('icons/xt.png') }}" alt="image">
                    </div> 
                    <p class="m-name">Foncham Harisson</p>
                    <p class="m-role">Developer</p>
                </div>
                <div class="team-member">
                    <div class="image-div">
                        <img src="{{ asset('we/peter.jpeg') }}" alt="image">
                    </div>
                    <div class="sm-icons">
                       <img src="{{ asset('icons/fby.png') }}" alt="facebook">
                       <img src="{{ asset('icons/ig.png') }}" alt="image">
                       <img src="{{ asset('icons/in.png') }}" alt="image">
                       <img src="{{ asset('icons/xt.png') }}" alt="image">
                    </div> 
                    <p class="m-name">Boh Peter</p>
                    <p class="m-role">Developer</p>
                </div>
                <div class="team-member">
                    <div class="image-div">.
                      <img src="{{ asset('we/promise.jpeg') }}" alt="image">
                    </div>
                    <div class="sm-icons">
                       <img src="{{ asset('icons/fby.png') }}" alt="facebook">
                       <img src="{{ asset('icons/ig.png') }}" alt="image">
                       <img src="{{ asset('icons/in.png') }}" alt="image">
                       <img src="{{ asset('icons/xt.png') }}" alt="image">
                    </div> 
                    <p class="m-name">Khan Promise</p>
                    <p class="m-role">Developer</p>
                </div>


            </div>
        </div>
        <div class="cta">
            <p>Are you <br><span>Looking for a lost item?</span></p>
            <button><a href="{{ route('posts.create') }}">Create An Account</a></button> 
        </div>
    </section>

</x-app-layout>