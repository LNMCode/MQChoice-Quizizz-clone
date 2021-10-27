<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
    @if ($idroom != null && $iduser != null)    
        <div class="id-room-accesss" id="idroom">{{$idroom}}</div>
        <div class="id-user-accesss" id="iduser">{{$iduser}}</div>
    @endif

    <p>This is host flow room</p>
    @include('foot')
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/host/hostflowroom.js"></script>
</html>