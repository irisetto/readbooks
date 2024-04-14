@extends('layouts.master')
@vite(['resources/css/login_register.css','resources/js/app.js','resources/js/login_register.js'])
@section('title', 'Login/Register')
@section('content')
    <div class="my_body">
    <section class="section container" id="container">
        <div class="form-container sign-up-container right next">
          <form name="register" action="{{ route('register') }}" method="POST">
            @csrf
            <h1 class="h1">Create Account</h1>
            <div class="register-info">
                      @error('name')
        <span class="a">{{ $message }}</span>
    @enderror
       @error('surname')
        <span class="a">{{ $message }}</span>
    @enderror
         @error('email')
        <span class="a">{{ $message }}</span>
    @enderror
    @error('password')
        <span class="a">{{ $message }}</span>
    @enderror
            <input type="text" placeholder="Last Name" class="input" name="name" required/>
    
            <input type="text" placeholder="First Name" class="input" name="surname" required/>
         
            <!-- <input type="text" placeholder="Username" class="input" name="username" required/> -->
            <input type="email" placeholder="Email" class="input" name="email" required/>
       
            <input type="password" placeholder="Password" class="input" name="password" required/>
            
            <!-- <input type="password" placeholder="Confirm Password" class="input" name="confirm-pass" required/> -->
            </div>
            <input type="submit" value="Sign up" class="submit" id="signUp">
          </form>
        </div>
        <div class="form-container sign-in-container left current">

          <form name="sign-in-form" action="{{ route('login') }}" method="POST" >
          @csrf
            <h1 class="h1">Sign in</h1>
            @error('email_login')
            <span class="a">{{ $message }}</span>
              @enderror
            <input type="text" placeholder="Email" class="input" name="email" required autofocus/>
  
            <input type="password" placeholder="Password" class="input" name="password" required/>
            <!-- <a class="a" href="#">Forgot your password?</a> -->
            <input type="submit" value="Sign in" class="submit" id="signIn">
          </form>
        </div>
        <div class="overlay-container">
          <div class="overlay">
            <div class="overlay-panel overlay-left left next">
              <h1 class="h1">Welcome Back!</h1>
              <p class="p">To keep connected with us please login with your personal info</p>
              <button class="ghost submit" id="signInOverlay">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right right current">
              <h1 class="h1">Hello, Fellow Reader!</h1>
              <p class="p">Enter your personal details and start journey with us</p>
              <button class="ghost submit" id="signUpOverlay">Sign Up</button>
            </div>
          </div>
        </div>
    </section>
</div>
@endsection