<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/roomques.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
</head>
<body>
    <div class="id-room-accesss invisible" id="idroom">{{$idroom}}</div>
    <div class="id-player-accesss invisible" id="iduser">{{$iduser}}</div>
    <!-- Swiper -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper swiper-no-swiping">
        @foreach ($listQues as $ques)
            <div class="swiper-slide">
                <section>
                    <div class="round-time-bar" id="round-time-bar" data-style="smooth" style="--duration: {{$ques['time']}};"><div></div></div>
                    
                    <div class="container-text">
                        <p> {{$ques['valuesques']}} </p>
                    </div>
                    <div class="row">
                        @foreach ($ques['ans'] as $ans)
                            <div class="option-ans col-lg-3">
                                <button id="{{$ques['idques']}}{{$ans['idans']}}" type="button" class="btn btn-{{$ans['colorv2']}}" onclick="onClickAns('{{$ques['correct']}}','{{$idroom}}', '{{$iduser}}', '{{$ques['idques']}}', '{{$ans['idans']}}', '{{$ans['valueans']}}', '{{json_encode($ques['ans'])}}', {{$loop->iteration}})">{{$ans['valueans']}}</button>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination" id="swiper-pagination"></div>
                    <button onclick="startTimeBar('{{$ques['time']}}',{{$loop->iteration}}, {{sizeof($listQues)}}, '{{$idroom}}', '{{$iduser}}', '{{$ques['idques']}}')" id="count-{{ $loop->iteration}}" class="invisible"></button>
                    
                    <button onclick="startTimeBar('{{$ques['time']}}', 1, {{sizeof($listQues)}}), '{{$idroom}}', '{{$iduser}}', '{{$ques['idques']}}'" id="btn-count-active" class="invisible"></button>
                </section>
            </div>
        @endforeach
    </div>
    
    <!-- TEST UI -->
    <div class="container-correct-question invisible" id="container-correct-question">
        <section>
            <div id="container-correct-bg">
                <div class="round-time-bar" id="round-time-bar-correct" data-style="smooth" style="--duration: 5;"><div></div></div>
                <p id="text-correct">Enter question</p>
            </div>
        </section>
    </div>
</body>
@include('socket')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="../../js/users/roomques.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        speed: 400,
        spaceBetween: 100,
        pagination: {
          el: ".swiper-pagination",
          type: "fraction",
        },
    });
</script>
</html>