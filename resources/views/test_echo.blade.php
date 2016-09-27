<html>
    <head>
        <title>Test</title>

        <base href="/">
    </head>
    <body>

        <div id="app">
            <my-component>loading...</my-component>
        </div>

        <script src="/vue.js"></script>
        <script src="/system.js"></script>
        <script src="/systemjs.config.js"></script>
        <script>
            System.import('js/app').catch(function(err){ console.error(err); });
        </script>

        {{--<script src="/js/system.js"></script>--}}
        {{--<script src="/js/systemjs.config.js"></script>--}}
        {{--<script>--}}
            {{--System--}}
                {{--.import('/js/app.js')--}}
                {{--.catch(function(err){ console.error(err); });--}}
{{--//        </script>--}}
    </body>
</html>