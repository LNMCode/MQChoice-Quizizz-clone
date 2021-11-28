<!DOCTYPE html>
<html lang="en">
<head>
  @include('head')
  <link rel="stylesheet" href="../../css/waitroomfinish.css">
</head>
<body>
    @yield('header')
    <div class="invisible" id="idroom">{{$idroom}}</div>
    <div class="invisible" id="iduser">{{$iduser}}</div>

    <section>
        <div class="container">
            <div class="container-players-accesss" id="containerplayerslist">
                <div>
                    <img src="../../image/userjoin/img9.jpg">
                    <span>{{$player['name']}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm cor cor-correct">
                    <p>{{$correctNumber}}</p>
                    <p>Chính xác</p>
                </div>
                <div class="col-sm cor cor-incorrect">
                    <p>{{$inCorrectNumber}}</p>
                    <p>Không chính xác</p>
                </div>
            </div>
            @foreach ($questions as $ques)
                <div class="question">
                    <p class="d-none">{{$indexQues = $loop->iteration}}</p>
                    <p>{{$ques['valuesques']}}</p>
                    @foreach ($ques['ans'] as $ans)
                        <p class="d-none">{{$idansplay = $player['play'][$indexQues-1]['idans']}}    </p>                  
                        <div class="answer d-flex items-center">
                            <span class="rounded-ans-dot rounded-ans-{{$idansplay == $ans['idans'] && $ans['idans'] == $ques['correct'] ? "green" : ($ans['idans'] == $idansplay && $idansplay != "null" ? "red" : ($ans['idans'] == $ques['correct'] && $idansplay != "null" ? "green" : "gray"))}}"></span>
                            <span><p class="rounded-ans-text">{{$ans['valueans']}}</p></span>
                        </div>
                    @endforeach
                </div>    
            @endforeach
        </div>
    </section>
    @include('socket')
    @include('foot')
    <script src="../../js/users/waitroomfinish.js"></script>
</body>
</html>
