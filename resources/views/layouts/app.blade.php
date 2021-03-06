@inject('sidebar', 'App\Services\LayoutSidebarService')
@inject('content', 'App\Services\LayoutContentService')

<html>
<head>
    <title>App</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:100,100i,300,300i,400,400i,700,700i&amp;subset=cyrillic-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- styles there -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token()
        ]); ?>

        window.token = '{{ $current->api_token }}';
    </script>
</head>
<body>
<div class="app-container">
    <div class="sidebar-wrapper">
        <div class="sidebar">
            <ul>
                {!! $sidebar->make(auth()->user()->permission) !!}
            </ul>
        </div>
    </div>
    <div class="app-content">
        <header class="app-header">
            <div class="grid">
                <div class="col-main">
                    <a href="javascript:" class="menu"><i class="material-icons">menu</i></a>
                    <form action="#" id="global-search">
                        <input id="global-search-input" type="text" placeholder="Введите фразу для поиска" data-input-keep-focused />
                        @include('layouts.search.results')
                    </form>
                </div>
                <div class="col-user-info pull-right">
                    <a href="javascript:" class="username">{{ auth()->user()->fullName() }}</a>
                    <a href="javascript:" class="bell" data-notification="10+"><i class="material-icons">notifications_none</i></a>
                </div>
            </div>
        </header>
        <div class="content">

            @yield('content')

            <div id="notifications-container"></div>

            {{--<div class="popup-notifications">--}}
                {{--<div class="notification notification-danger">--}}
                    {{--<div class="notification-content">--}}
                        {{--<div>--}}
                            {{--Hello world!--}}
                        {{--</div>--}}
                        {{--<div class="notification-actions">--}}
                            {{--<div class="btn-group">--}}
                                {{--<a href="javascript:" class="btn">Show more</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="notification-close">--}}
                        {{--<i class="material-icons">close</i>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="notification notification-success">--}}
                    {{--<div class="notification-content">--}}
                        {{--<div>--}}
                            {{--Hello world!--}}
                        {{--</div>--}}
                        {{--<div class="notification-actions">--}}
                            {{--<div class="btn-group">--}}
                                {{--<a href="javascript:" class="btn">Show more</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="notification-close">--}}
                        {{--<i class="material-icons">close</i>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
</div>

<div id="offscreen-test-view-zone"></div>

<!-- app js resources -->
<script src="//ehospital.dev:5888/socket.io/socket.io.js"></script>
<script src="/vendor/systemjs/dist/system.js"></script>
<script>
    window.currentPage = '{{ request()->route()->getName() }}';

    SystemJS.config({
        defaultJSExtensions: true,
        baseURL: '/js',
        map: {
            'react': '/vendor/react/dist/react.js',
            'react-dom': '/vendor/react-dom/dist/react-dom.js',
            'text': '/vendor/systemjs-plugin-text/text.js',
            'whatwg-fetch': '/vendor/whatwg-fetch/fetch.js',
            'json': '/vendor/systemjs-plugin-json/json.js',
            'socket.io-client': ['@', 'empty'].join('')
        }
    });

    window.user = {
        id: {{ auth()->id() }}
    };

    SystemJS.import("app.js").then(null, console.error.bind(console));
</script>
</body>
</html>