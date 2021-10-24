<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/roomques.css">
</head>
<body>
    <div class="id-room-accesss" id="idroom">{{$idroom}}</div>
    <div class="id-player-accesss" id="iduser">{{$iduser}}</div>
    <br>
    <p>Welcome to question :))</p>
    @foreach ($listQues as $ques)
        <b> {{$ques['valuesques']}} </b>
        <p> {{ $ques['ans'][0]['valueans']}} </p>
        @foreach ($ques['ans'] as $ans)
            <button id="{{$ques['idques']}}{{$ans['idans']}}" type="button" class="btn btn-{{$ans['color']}}" onclick="onClickAns('{{$idroom}}', '{{$iduser}}', '{{$ques['idques']}}', '{{$ans['idans']}}', '{{$ans['valueans']}}', '{{json_encode($ques['ans'])}}')">{{$ans['valueans']}}</button>
        @endforeach
    @endforeach
    @include('foot')
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/users/roomques.js"></script>
</html>