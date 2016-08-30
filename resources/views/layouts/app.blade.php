@inject('sidebar', 'App\Services\LayoutSidebarService')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                {!! $sidebar->link('atcClassification.index') !!}
            </nav>
        </div>
        <div class="content">

            <header class="header">
                <nav>
                    <div class="pull-right">
                        <span class="like-link">Alexey Rudkovskiy</span>
                        <a href="javascript:">logout</a>
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

    @if ( config('app.debug') && isset($current) ? in_array($current->email, ['test@test.test']) : false )
        <script type="text/javascript">
            document.write('<script src="//ehospital.testbed.com.ua:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
        </script>
    @endif

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
