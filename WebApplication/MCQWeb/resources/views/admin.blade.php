<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
    This is admin page of 
    <br>
    {{$data['username']}}
    {{$data['id']}}
    <br>
    @if(count($rooms)>0)
        @foreach ($rooms as $room)
            <br>
            <a href="/manageroom/{{$room['idroom']}}">{{$room['title']}}</a>
        @endforeach
    @else
        <b>Deo co cai room nao het</b>
    @endif

    @include('foot')
</body>
</html>