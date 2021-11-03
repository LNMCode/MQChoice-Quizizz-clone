<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/joinroom.css">
</head>
<body>
    <section>
        <div class="content">
            <div class="id-room-accesss invisible" id="idroom">{{$room['idroom']}}</div>
            <div class="id-player-accesss invisible" id="iduser">{{$iduser}}</div>
            <div class="id-player-accesss invisible" id="nameuser">{{$nameuser}}</div>
            <br>
            @if ($isCheckStart)
                <button type="button" class="btn btn-primary">Yes</button>
                <button type="button" class="btn btn-secondary">No and continous</button>
            @endif
            
            <div class="board">
                <p>Chào mừng {{$nameuser}} đã tham gia</p>
                @if ($room != null)
                    <div class="idroom">
                        <p>{{$room['idroom']}}</p>                    
                    </div>
                    <p>Vui lòng chờ chủ phòng bắt đầu</p>
                @else
                    <b>Da xay ra loi</b>
                @endif
            </div>
            
            <div class="container-players-accesss" id="containerplayerslist">
                <div>
                    <img src="../image/userjoin/img{{substr($iduser, -1)}}.jpg">
                    <span>{{$nameuser}}</span>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/users/joinroom.js"></script>
</html>