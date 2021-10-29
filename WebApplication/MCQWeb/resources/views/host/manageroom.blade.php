<!DOCTYPE html>
<html lang="en">
<head>
    @include('headnewroom')
    <link rel="stylesheet" href="../../css/manageroom.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @section('header')
        <header id="header-save">
            <a href="/" class="logo"><img src="../image/logo.jpg" alt=""></a>
            <ul>
                <li><a href="/admin" class="signup">Admin page</a></li>
            </ul>
        </header>
    @endsection
    @yield('header')

    <section class="enter-name-room">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit room</h3>
            </div>
            <div class="card-body">
                <form action="{{$url.'/updateroom'}}" method="get">
                    <div class="form-group">
                        <label for="nameofroom">Name of room</label>
                        <input type="text" class="form-control mb-2" id="nameofroom" placeholder="{{isset($room) ? $room['title'] : 'Enter name room'}}" name="nameroom" value="{{isset($room) ? $room['title'] : ''}}" required>
                    </div>
                    <div class="form-group">
                        <label for="desriptionofroom">Description</label>
                        <textarea type="text" class="form-control mb-2" id="desriptionofroom" placeholder="{{isset($room) ? $room['desription'] : 'Enter description room'}}" rows="3" name="desriptionroom" required>{{isset($room) ? $room['desription'] : ''}}</textarea>
                    </div>                    
                    @if (isset($room))
                        <input type="text" class="invisible d-none" value="{{$room['idroom']}}" name="idroom">
                    @endif
                    <button type="submit" href="#" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </section>

    <section class="content">        
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable ques-content">
                    @if ($room != null)
                        @foreach ($room['data'] as $ques)
                            <div class="card">
                                <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-check-square"></i>
                                    Question {{ $loop->iteration }}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#edit-ques-content-{{$ques['idques']}}" data-toggle="collapse" aria-expanded="false" aria-controls="edit-ques-content-{{$ques['idques']}}">Edit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{$url}}/delquestion?idroom={{$room['idroom']}}&idques={{$ques['idques']}}">
                                            <i class="far fa-trash-alt"></i>
                                            Remove
                                        </a>
                                    </li>
                                    </ul>
                                </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content p-0">
                                        <p>{{$ques['valuesques']}}</p>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($ques['ans'] as $ans)
                                                <div class="col-lg-6 d-flex items-center">
                                                    <span class="rounded-ans rounded-ans-{{$ans['color']}}"></span>
                                                    <span><p class="rounded-ans-text">{{$ans['valueans']}}</p></span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div id="edit-ques-content-{{$ques['idques']}}" class="collapse card-body">
                                    <form action="{{$url.'/updatequestion'}}" method="get">
                                        <div class="form-group">
                                            <label for="titlequestion">Enter question</label>
                                            <textarea type="text" class="form-control textarea-none-resize" id="titlequestion" placeholder="Enter question" name="titlequestion" rows="2" required>{{$ques['valuesques']}}</textarea>
                                        </div>
                                        <div class="row">
                                            @foreach ($ques['ans'] as $ans)
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body d-block">
                                                            <div class="form-check mb-4">
                                                                <input class="form-check-input check-input-custom" type="radio" name="answer" id="{{$ans['idans']}}" value="{{$ans['idans']}}" title="Mark this as the correct answer" required {{$ans['idans'] == $ques['correct'] ? 'checked' : ''}}>
                                                            </div>
                                                            <textarea type="text" class="form-control wrap-text text-center text-break textarea-none-resize col mt-5" placeholder="Answer" rows="4" required name="{{$ans['idans']}}">{{$ans['valueans']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if (isset($room))
                                            <input type="text" class="invisible d-none" value="{{$room['idroom']}}" name="idroom">
                                            <input type="text" class="invisible d-none" value="{{$ques['idques']}}" name="idques">
                                        @endif
                                        <button type="submit" class="btn btn-primary d-block mx-auto">Save</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Khong co cau hoi nao, vui long tao moi</p>
                    @endif
                    
                </section>
                <section class="col-lg-5 connectedSortable"></section>
            </div>
        </div>
    </section>
    <button class="btn btn-warning" id="btn-add-question" onclick="onShowContainer()">Add Question</button>
    <div class="container-add-question invisible" id="container-add-question">
        <section>
            <div>
                <form action="{{$url}}/addquestion" method="get">
                    <div class="form-group">
                        <label for="titlequestion">Enter question</label>
                        <textarea type="text" class="form-control textarea-none-resize" id="titlequestion" placeholder="Enter question" name="titlequestion" rows="5" required></textarea>
                    </div>
                    <div class="row">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="col">
                                <div class="card">
                                    <div class="card-body d-block">
                                        <div class="form-check mb-4">
                                            <input class="form-check-input check-input-custom" type="radio" name="answer" id="answer{{$i+1}}" value="ans{{$i+1}}" title="Mark this as the correct answer" required>
                                        </div>
                                        <textarea type="text" class="form-control wrap-text text-center text-break textarea-none-resize col mt-5" placeholder="Answer {{$i+1}}" rows="4" required name="valueans{{$i+1}}"></textarea>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    @if (isset($room))
                        <input type="text" class="invisible d-none" value="{{$room['idroom']}}" name="idroom">
                        <input type="text" class="invisible d-none" value="{{count($room['data'])+1}}" name="index">
                    @endif
                    <button type="submit" class="btn btn-primary d-block mx-auto">Save</button>
                </form>
                <button class="btn btn-primary mt-3" onclick="onHideContainer()">Cancel</button>
            </div>
        </section>
    </div>
    @include('footnewroom')
    <script src="../../js/host/manageroom.js"></script>
</body>
</html>