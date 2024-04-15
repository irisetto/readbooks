@vite(['resources/css/app.css','resources/js/app.js'])
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Viga"
  />
  <link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Montserrat"
/>
<nav class="transform scale-98 filter drop-shadow-l bg-grey-100 mx-auto">
  <div class="px-8 border mx-auto rounded-md  drop-shadow-md ">
    <div class="flex justify-between">
      <!-- logo -->
      <div>
            <a href="#" class="flex items-center py-5 px-3">
              <svg class="h-6 w-6 mr-3 text-blue-400" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
</svg>
              <span class="text-lg">read</span>
              <span class="font-bold text-lg">books</span>
            </a>
        
          </div>
      <!-- Primary Navigation -->
      <div class="hidden md:flex items-center justify-center space-x-1">
        <a class="font-serif py-5 px-7 text-gray-700 hover:text-gray-900" href="{{ url('/') }}">Home</a>
        <a class="font-serif py-5  text-gray-700 hover:text-gray-900" href="{{ url('/books') }}">Books</a>
        @auth
        <a class="font-serif py-5 px-7 text-gray-700 hover:text-gray-900" href="{{ url('/my_books') }}">My books</a>
        @endauth
       <!-- <a class="py-5 px-2 text-gray-700 hover:text-gray-900" href="#">Revenues</a>
        <a class="py-5 px-2 text-gray-700 hover:text-gray-900" href="#">Insights</a>-->
      </div>
      <!-- Secondary Navigation -->
      <div class="hidden md:flex items-center space-x-1">
        @auth       
            Hello, {{auth()->user()->surname}}!     
          <a href="{{ route('logout') }}" class="m-3 py-2 px-3 bg-indig hover:text-blue-100 text-blue-200 transition duration-300 rounded shadow" >Logout</a>
    
        @endauth
        @guest
        <a class="py-5 px-3 text-gray-800 hover:text-gray-900" href="{{ url('/login_register?page=login') }}">Login</a>
        <a class="py-2 px-3 bg-indig hover:text-blue-100 text-blue-200 transition duration-300 rounded shadow" href="{{ url('/login_register?page=register') }}">Register</a>
        @endguest
      </div>
       <!-- Mobile Menu -->
      <div class="md:hidden flex items-center">
      <button class="mobile-menu-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" /></svg>
      </button>
      </div>
  </div>
  </div>
  <div class="mobile-menu hidden flex flex-col justify-center md:hidden">
    <a href="{{ url('/') }}" class="block py-2 px-4 text-sm hover:bg-gray-200 text-center">Home</a>
    <a href="{{ url('/books') }}" class="block py-2 px-4 text-sm hover:bg-gray-200 text-center">Books</a>
    @auth
    <a href="{{ url('/my_books') }}" class="block py-2 px-4 text-sm hover:bg-gray-200 text-center">My books</a>

      <a href="{{ route('logout') }}" class="block py-2 px-4 text-sm hover:bg-gray-200 text-center">Logout</a>
   
    @endauth
    @guest
    <a href="{{ url('/login_register?page=login') }}" class="block py-2 px-4 text-sm hover:bg-gray-200 text-center">Login</a>
    <a href="{{ url('/login_register?page=register') }}" class="block py-2 px-4 text-sm hover:bg-gray-200 text-center">Register</a>
    @endguest
  </div>
</nav>
<script>
      const btn = document.querySelector('button.mobile-menu-button');
  const menu = document.querySelector('.mobile-menu');

  btn.addEventListener('click', () => {
    menu.classList.toggle("hidden");
  });
  </script>