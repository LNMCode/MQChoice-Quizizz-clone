<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
    @section('content')
        <p>This is my body manage question.</p>
        @if ($room != null)
            <p>{{$room['title']}}</p>
            <a href="/host/{{$room['idroom']}}">Open room {{$room['idroom']}}</a>
        @else
            <b>Da xay ra loi</b>
        @endif
    @endsection

    @yield('content')

    @include('foot')
</body>
</html>