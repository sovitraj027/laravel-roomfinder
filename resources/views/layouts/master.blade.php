@include('_partialstest._header')

<body>
    <div class="wrapper">
        @include('_partialstest._sidebar')
        <div id="content" class="w-100">
            <div>
                @include('_partialstest._navbar')

                @yield('content')
                <br>
                <br>
                @include('_partialstest._footer')
            </div>
        </div>
        @include('_partialstest._script')
    </div>

</body>

</html>