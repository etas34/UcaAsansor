@include('layouts.header')
@include('layouts.sidebar')

@yield('content')


@include('layouts.footer')
@stack('scripts')
