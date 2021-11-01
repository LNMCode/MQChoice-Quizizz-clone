<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/hostroom.css">
</head>
<body>
    @if ($room != null && $iduser != null)    
        <div class="id-room-accesss invisible" id="idroom-d">{{$room['idroom']}}</div>
        <div class="id-user-accesss invisible" id="iduser-d">{{$iduser}}</div>
    @endif

    @section('content')
        <div class="board">
            <p>Để chơi bài kiểm tra này</p>
            <p>Nhập mã tham gia vào bài kiểm tra</p>
            @if ($room != null)
                <div class="idroom">
                    <p>{{$room['idroom']}}</p>                    
                </div>
                <button type="button" class="btn btn-primary" id='btnStartRoom' value="{{$room['idroom']}}" onclick="onStartRoom(this)">Start room</button> 
            @else
                <b>Da xay ra loi</b>
            @endif
        </div>
    @endsection

    @section('players')
        <div class="board-player" id="board-player">
            <br>
            <p>Chờ người tham gia vào phòng</p>
        </div>
        <div class="container-players-accesss" id="containerplayerslist">
            <div>
                <img src="../image/userjoin/img{{rand(1,6)}}.jpg">
                <span>Phi Long</span>
            </div>
        </div>
    @endsection

    <section>
        @yield('content')
    </section>
    @yield('players')

    @include('foot')
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/host/hostroom.js"></script>
</html>