<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">

    <title>@yield('title')</title>
    
  </head>
  <body>
  </style>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/login">Upload-Report</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>   
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @if(Auth::user()) 
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
      @if(Request::path() != 'uploads')
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/uploads">Home</a>
        </li>
      @endif
      @if(Request::path() != 'uploads/create' && Auth::user()->role=='1')
        <li class="nav-item">
          <a class="nav-link " href="/uploads/create">Upload</a>
        </li>
      @endif
      @if(Request::path() != 'uploads/role' && Auth::user()->role=='3')
        <li class="nav-item">
          <a class="nav-link " href="/uploads/role">Role</a>
        </li>
      @endif
        </ul>
        <ul class="nav justify-content-end">
          <span class="navbar-text">
          {{Auth::user()->name}}&nbsp;&nbsp;&nbsp;
          </span>
          <form action="{{url('/logout')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input class="btn btn-primary" type="submit" value="Logout">
          </form>
        </ul>
    @endif
  </div>
    @if(Request::path() == 'login') 
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="btn btn-primary" href="/register" role="button">Register</a>
        </li>
      </ul>
    @endif  
    @if(Request::path() == 'register') 
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="btn btn-primary" href="/login" role="button">Login</a>
        </li>
      </ul>
    @endif 
    @if(Request::path() == '/') 
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="btn btn-primary" href="/login" role="button">Login</a>
        </li>
      </ul>
    @endif   
  </div> 
</nav>
      <div class="container">
            @yield('content')
        </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
  
  </body>
</html>