<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/hostflowroom.css">
</head>
<body>
    <header>
        <p>MQChoice</p>
        <div class="coderoom">
            <p class="text">Mã phòng</p>
            <p class="id">{{$idroom}}</p>
        </div>
        <ul>
            <li><button type="button" class="btn signup" id='btnCloseRoom' value="{{$idroom}}" onclick="onCloseRoom(this)">Kết thúc</button>          
            </li>
        </ul>
    </header>

    <section>
        <div class="report-player-ngoai">
            @foreach ($room['players'] as $player)
                <div class="report-player"style="top: 0px;">
                    <div class="wrap-god-card-bg"></div>
                    <div class="idx">
                        <div class="idx-value">{{$loop->iteration}}</div>
                    </div>
                    <div class="player-img">
                        <div class="player-img-circle" style="background-image: url(&quot;https://cf.quizizz.com/join/img/avatars/tablet_sm/monster26.png&quot;);"></div>
                    </div>
                    <div class="player-name">{{$player['name']}}</div>
                    <div class="player-progress">
                        <div class="progress">
                            <div class="progress-inner" id='progress-inner'>
                                <div class="correct" id="correct-{{$player['id']}}"></div>
                                <div class="incorrect" id="incorrect-{{$player['id']}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    

    @if ($idroom != null && $iduser != null)    
        <div class="id-room-accesss invisible" id="idroom">{{$idroom}}</div>
        <div class="id-user-accesss invisible" id="iduser">{{$iduser}}</div>
        <div class="invisible" id="number-question">{{sizeof($room['data'])}}</div>
    @endif


    @include('foot')
</body>
@include('socket')
<script src="../../js/host/hostflowroom.js"></script>
</html>