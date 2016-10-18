@inject('sidebar', 'App\Services\LayoutSidebarService')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="/" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EHospital</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div class="container">
        <div class="sidebar">
            <nav>
                <a href="javascript:" class="force-hover">EHospital</a>
                {!! $sidebar->link('organization.index') !!}
                {!! $sidebar->link('user.index') !!}
                {!! $sidebar->link('contractor.index') !!}
                {!! $sidebar->link('department.index') !!}
                {!! $sidebar->link('manufacturer.index') !!}
                {!! $sidebar->link('medicament.index') !!}
                {!! $sidebar->link('atcClassification.index', '999+') !!}
                {!! $sidebar->link('patient.index') !!}
                {!! $sidebar->link('sourceOfFinancing.index') !!}
                {!! $sidebar->link('medicamentIncome.index') !!}
            </nav>
        </div>
        <div class="content">

            <header class="header">
                <nav>
                    <div class="pull-right">
                        <span class="like-link">{{ auth()->user()->fullName() }}</span>
                        <a href="/logout">logout</a>
                    </div>
                </nav>
            </header>

            <div class="paddings">

                <div class="breadcrumbs">
                    <nav>
                        <div class="breadcrumbs-links">
                            @foreach($breadcrumbs as $breadcrumb)
                            <a href="javascript:" class="item">{{ trans($breadcrumb) }}</a>
                            @endforeach
                        </div>
                        <div class="actions">
                            @stack('breadcrumbs-right')
                        </div>
                    </nav>
                </div>

                <div class="clear"></div>

                <div id="page-content">
                    @yield('content')
                </div>

            </div>

        </div>
    </div>

    <notifications-list></notifications-list>

    {{--@if ( config('app.debug') && isset($current) ? in_array($current->email, ['test@test.test']) : false )--}}
        {{--<script type="text/javascript">--}}
            {{--document.write('<script src="{{ url('/') }}:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')--}}
        {{--</script>--}}
    {{--@endif--}}

    <script>
        window.page = "{{ request()->route()->getName() }}";
        window.prefix = "{{ $prefix or 'management' }}";
        window.token = "{{ auth()->user()->api_token }}";
        window.uid = {{ auth()->user()->id }};
    </script>

    @stack('scripts')

    @if(session()->has('message'))
    <script>
        window.message = JSON.parse('{!! session()->get('message') !!}');
    </script>
    @endif

    <!-- Scripts -->
    <script src="{{ url('/') }}:{{ config('eh.echo.port') }}/socket.io/socket.io.js"></script>
    <script src="/vendor/system.js"></script>
    <script src="/systemjs.config.js"></script>
    <script>
        System.import('js/app').catch(function(err){ console.error(err); });
    </script>
</body>
</html>
