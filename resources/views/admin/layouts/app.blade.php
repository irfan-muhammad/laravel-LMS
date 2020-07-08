<html lang="{{ app()->getLocale() }}">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Admin Panel</title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Laravel Admin Panel</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{ url('/auth/logout') }}">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              @if (Auth::guest())
            <li>
              <a href="{{ url('/auth/login') }}">Login</a>
            </li>
            <li>
              <a href="{{ url('/auth/register') }}">Register</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/categories') }}">
                  <span data-feather="file"></span>
                  Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/categories/create') }}">
                  <span data-feather="file"></span>
                  Add New Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/courses') }}">
                  <span data-feather="file"></span>
                  Courses
                </a>
            </li>
            <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
             <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>

            @endif
            </ul>



          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('title')</h1>
                @if (Session::has('message'))
                <div class="flash alert-info">
                    <p class="panel-body">
                    {{ Session::get('message') }}
                    </p>
                </div>
                @endif
                @if ($errors->any())
                <div class='flash alert-danger'>
                    <ul class="panel-body">
                    @foreach ( $errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                    </ul>
                </div>
                @endif
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">

              @yield('title-meta')
            </div>
            <div class="panel-body">
              @yield('content')
            </div>
          </div>



        </main>
      </div>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  </body>
</html>
