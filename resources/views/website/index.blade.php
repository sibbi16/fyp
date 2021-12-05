<x-website-layout>
        <header>
            <img class="img-fluid logo" src="{{asset('images/logo.png')}}" alt="logo">
            <div class="register">
                <a href="{{route('login')}}" class="btn btn-lg btn-primary">Login</a>
                <a href="{{route('register')}}" class="btn btn-lg btn-primary">Register</a>
            </div>
        </header>
   <section id="banner">
    <div class="overlay"></div>
   </section>
   <footer>&copy; Copyright {{\Carbon\Carbon::now()->year }}. All Right Reserved<br>Design Developed & Managed by <a href="#"><strong>Sibghat & Usama</strong></a></footer>
</x-website-layout>
