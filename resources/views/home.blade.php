<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="css/home.css">
      <script src="{{ asset('js/app.js') }}" defer></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
      <title>Admin</title>
    </head>
    <body>
      <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Buqo
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      
                                  <a class="dropdown-item " href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} 
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="GET">
                              <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
                              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>                        
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
          <div class="">
              <div class="">
                  <div class="card mt-4 mb-4">
                      <div class="card-header d-flex justify-content-between">
                        {{ __('Dashboard') }} 
                        <a href="/add/create"><button type="button" class="btn btn-primary">add book</button></a>
                      </div>

                      <div class="card-body">
                        <div class="body-card d-flex flex-row justify-content-around mt-4">
                          @foreach ($books as $index => $book)
                            <div class="card rounded mt-4" style="width: 16rem;"  >
                              <div class="text-center mt-2 mb-2">
                                <h6>{{$book->judul}}</h6>
                              </div>
                              <div class="d-flex justify-content-center">                        
                                <img src={{ asset('cover/'. $book-> gambar)}} alt="" width="200" class="rounded">
                              </div>
                              <form method="POST" action="{{ route('home.destroy', $book->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="card-body m-2">
                                    <a href="{{route('add.edit',  $book->id)}}"><button type="button" class="btn btn-success">edit</button></a>
                                    <button type="submit" class="btn btn-warning">delete</button>
                                </div>
                            </form>
                            </div> 
                            @endforeach              
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          
        </div>
      </div>

    </body>
    </html>