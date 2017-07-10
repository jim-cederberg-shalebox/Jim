<!DOCTYPE html>
<html>
  <head>
    <title>ShaleBox</title>
    <style>
     #container {
       font-family: sans-serif;
       margin: auto;
       width: 60%;
     }

     #header {
       background-color: #33ccff;
       border-style: solid;
       border-width: 1px;
       height: 70px;
       margin: 0 0 15px 0;
       text-align: right;
     }

     #header-logo {
       height: 70px;
       float: left;
       width: 250px;
     }

     #nav-container {
       height: 200px;
       vertical-align: middle;
       width: 100%;
     }

     .nav-element {
       padding: 0 8px 0 8px;
     }

     #body-main {

     }
    </style>
  </head>
</html>
<body>
  <div id="container">
    <div id="header">
      <img src="{{ asset('logo.png') }}" id="header-logo"/>
      <span id="nav-container">
        @if (Auth::guest())
          <a href="{{ route('login') }}" class="nav-element">
            Login
          </a>
          <a href="{{ route('register') }}" class="nav-element">
            Register
          </a>
        @else
          <a href="{{ route('new_layout') }}" class="nav-element"> <!-- my_account -->
            My Account
          </a>
          <a href="{{ route('new_layout') }}" class="nav-element"> <!-- buy_data -->
            Buy Data
          </a>
          <a href="{{ route('new_layout') }}" class="nav-element"> <!-- sell_data -->
            Sell Data
          </a>
          <a href="{{ route('logout') }}" class="nav-element" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
        @endif
    </div>
    <div id="body-main">
      @if (Auth::guest())
        <span>
          Please <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a>
        </span>
      @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        @yield('content')
      @endif
    </div>
  </div>
</body>
