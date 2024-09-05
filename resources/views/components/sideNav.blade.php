<div class="sidenav">
    <div class="logo-box">

        <p class="logo">Instagram</p>
    </div>

    <div class="navlink-box">
        <a href="/" class="navlink">
            <div class="container">
                <div class="home-icon-box">
                    <img class="home-icon" src="{{ asset('images/homee.png') }}" alt="">
                </div>
                <div class="link-to">
                    Home
                </div>
            </div>

        </a>
        
    </div>
    <div class="navlink-box">
        <a href="/findfriends" class="navlink">
            <div class="container">
                <div class="home-icon-box">
                    <img class="home-icon" src="{{ asset('images/search.png') }}" alt="">
                </div>
                <div class="link-to">
                    Search
                </div>
            </div>

        </a>
        
    </div>
    
    <div class="navlink-box">
        <a href="/chat" class="navlink">
            <div class="container">
                <div class="home-icon-box">
                    <img class="home-icon" src="{{ asset('images/dm.png') }}" alt="">
                </div>
                <div class="link-to">
                    Message
                </div>
            </div>

        </a>
        
    </div>
    
    <div class="navlink-box">
        <a href="/newpost" class="navlink">
            <div class="container">
                <div class="home-icon-box">
                    <img style="background: white" class="home-icon" src="{{ asset('images/add.png') }}" alt="">
                </div>
                <div class="link-to">
                    Create Post
                </div>
            </div>

        </a>
        
    </div>
    <div class="navlink-box">
        <a href="/profile/{{ auth()->user()->id }}" class="navlink">
            <div class="container">
                <div class="account-nav-profile">
                    <img src="{{ asset('storage/'.auth()->user()->profile_url) }}" alt="" class="account-profile-img">
                </div>
                <div class="link-to">
                    {{auth()->user()->name}}
                </div>
            </div>

        </a>
        
    </div>
    <div class="navlink-box">
        <a href="" class="navlink">
            <div class="container">
                    
                <div class="link-to">
                    <form action="/logout" class="logout-form" method="POST">
                        @csrf
                        <button class="logout-btn" type="submit">LogOut</button>
                    </form>
                </div>
            </div>

        </a>
        
    </div>

</div>