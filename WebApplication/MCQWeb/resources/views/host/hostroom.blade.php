<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>

    @section('content')
        <p>This is my body hostroom.</p>
        @if ($room != null)
            <p>{{$room['title']}}</p>
            <button type="button" class="btn btn-primary" id='btnStartRoom' value="{{$room['idroom']}}" onclick="onStartRoom(this)">Start Room {{$room['idroom']}}</button> 
            
            <button type="button" class="btn btn-danger" id='btnCloseRoom' value="{{$room['idroom']}}" onclick="onCloseRoom(this)">Close Room {{$room['idroom']}}</button>          
        @else
            <b>Da xay ra loi</b>
        @endif
    @endsection
    @yield('content')

    @section('players')
        <br>
        <b>Danh sach users tham gia</b>
    @endsection
    @yield('players')


    @include('foot')
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/host/hostroom.js"></script>
</html>