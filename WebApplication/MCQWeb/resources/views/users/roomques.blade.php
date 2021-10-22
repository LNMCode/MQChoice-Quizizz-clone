<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
    <br>
    <p>Welcome to question :))</p>
    @foreach ($listQues as $ques)
        <b> {{$ques['valuesques']}} </b>
        <p> {{ $ques['ans'][0]['valueans']}} </p>
        @foreach ($ques['ans'] as $ans)
            <button type="button" class="btn btn-{{$ans['color']}}" onclick="onClickAns('{{$idroom}}', '{{$iduser}}', '{{$ques['idques']}}', '{{$ans['idans']}}', '{{$ans['valueans']}}')">{{$ans['valueans']}}</button>
        @endforeach
    @endforeach
    @include('foot')
</body>
<script src="https://cdn.socket.io/4.3.2/socket.io.min.js" integrity="sha384-KAZ4DtjNhLChOB/hxXuKqhMLYvx3b5MlT55xPEiNmREKRzeEm+RVPlTnAn0ajQNs" crossorigin="anonymous"></script>
<script src="../../js/users/joinroom.js"></script>
</html>