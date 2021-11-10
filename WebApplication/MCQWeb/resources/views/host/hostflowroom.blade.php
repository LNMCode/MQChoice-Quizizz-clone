<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/hostflowroom.css">
</head>
<body>
    @if ($idroom != null && $iduser != null)    
        <div class="id-room-accesss invisible" id="idroom">{{$idroom}}</div>
        <div class="id-user-accesss invisible" id="iduser">{{$iduser}}</div>
    @endif

    <button type="button" class="btn btn-danger" id='btnCloseRoom' value="{{$idroom}}" onclick="onCloseRoom(this)">Close Room {{$idroom}}</button>          

    <p>This is host flow room</p>
    @include('foot')
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/host/hostflowroom.js"></script>
</html>