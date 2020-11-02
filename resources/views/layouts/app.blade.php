<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(Session::has('success'))
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="alert alert-info">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                @if(Session::has('error'))
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="alert alert-warning">
                                    {{ Session::get('error') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @yield('content')
        </main>
    </div>
</body>
<script>
    let dragDropData = {
        draggedItemId: null,
        targetItemId: null,
        projectId: null,
        dragItemIndex: null,
        dropItemIndex: null
    };
    function preventDrop(evnt) {
        evnt.preventDefault();
    }

    function drag(ev) {
        dragDropData.draggedItemId = ev.target.attributes['data-id'].value;
        dragDropData.projectId = ev.target.attributes['data-pid'].value;
        dragDropData.dragItemIndex = ev.target.attributes['data-priority'].value;
    }

    function drop(ev) {
        ev.preventDefault();
        dragDropData.targetItemId = document.getElementById(ev.target.id).parentNode.attributes['data-id'].value;
        dragDropData.dropItemIndex = document.getElementById(ev.target.id).parentNode.attributes['data-priority'].value;
        handleChange();
    }

    function handleChange() {
        axios.get(`/task/order?dragged_item=${dragDropData.draggedItemId}&target_item=${dragDropData.targetItemId}&project_id=${dragDropData.projectId}&drag_index=${dragDropData.dragItemIndex}&drop_index=${dragDropData.dropItemIndex}`).then(function(response) {
           document.getElementById('task_list').innerHTML = response.data;
        });
    }

    function handleLoad() {
        let e = document.getElementById("project");
        let projectId = e.options[e.selectedIndex].value;
        axios.get(`/task/partial/${projectId}`).then(function(response) {
            document.getElementById('task_list').innerHTML = response.data;
        });
    }
</script>
</html>
