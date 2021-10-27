<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/joinroom.css">
</head>
<body>
    <div class="id-room-accesss" id="idroom">{{$room['idroom']}}</div>
    <div class="id-player-accesss" id="iduser">{{$iduser}}</div>
    <div class="id-player-accesss" id="nameuser">{{$nameuser}}</div>
    <br>
    <p>{{ $textBody }}</p>
    @if ($isCheckStart)
        <button type="button" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary">No and continous</button>
    @endif
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/users/joinroom.js"></script>
</html>