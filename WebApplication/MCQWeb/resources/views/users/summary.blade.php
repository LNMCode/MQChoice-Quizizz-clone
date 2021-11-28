<!DOCTYPE html>
<html lang="en">
<head>
  @include('head')
  <link rel="stylesheet" href="../../css/summary.css">
</head>
<body>
    @yield('header')
    <section>
        <div class="container">
            <div class="container-card">
                <div class="container-card-rank">
                    <img src="../../image/cup-icon.png" alt="#">
                    <p>Your ranked</p>
                    <p class="number">{{array_search($iduser, array_keys($rankedlist)) + 1}}</p>
                </div>
            </div>
            <div class="container-list">    
                @foreach ($rankedlist as $x => $x_value)
                    <div class="container-list-item card">
                        <div class="card-body">
                            <span>{{$loop->iteration}}</span>
                            @foreach ($players as $player)
                                @if ($player['id'] == $x)
                                    <span class="name">{{$player['name']}}</span>
                                    <span class="score">Score: {{$x_value}}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('foot')
</body>
</html>
