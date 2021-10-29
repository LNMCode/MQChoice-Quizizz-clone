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
            <ul id="ul-header-save">
                <li id="li-header-save"><a id="save-room" href="/save">Save</a></li>
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
                <form action="">
                    <div class="form-group">
                        <label for="nameofroom">Name of room</label>
                        <input type="text" class="form-control mb-2" id="nameofroom" placeholder="{{isset($room) ? $room['title'] : 'Enter name room'}}" name="nameroom" value="{{isset($room) ? $room['title'] : ''}}" required>
                    </div>
                    <div class="form-group">
                        <label for="desriptionofroom">Description</label>
                        <textarea type="text" class="form-control mb-2" id="desriptionofroom" placeholder="{{isset($room) ? $room['desription'] : 'Enter description room'}}" rows="3" name="desriptionroom" required>{{isset($room) ? $room['desription'] : ''}}</textarea>
                    </div>
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
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">
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
                                    <form action="#" method="get">
                                        <div class="form-group row">
                                        <label for="inputQuestion" class="col-sm-2 col-form-label">Question</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputQuestion" placeholder="{{$ques['valuesques']}}" name="inputQuestion">
                                        </div>
                                        </div>
                                        <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-2 pt-0">Answers</legend>
                                            <div class="col-sm-10">
                                                
                                            @foreach ($ques['ans'] as $ans)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" {{$ques['correct'] == $ans['idans'] ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="gridRadios1">{{$ans['valueans']}}</label>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                        </fieldset>
                                        <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </div>
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
                <form action="{{$url}}/addquestion" method="get" id="addquestion-form">
                    <div class="form-group">
                        <label for="titlequestion">Name of room</label>
                        <textarea type="text" class="form-control textarea-none-resize" id="titlequestion" placeholder="Enter question" name="titlequestion" rows="5" required></textarea>
                    </div>
                    <div class="row">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="col">
                                <div class="card">
                                    <div class="card-body d-block">
                                        <div class="form-check mb-4">
                                            <input class="form-check-input check-input-custom" type="radio" name="answer" id="answer{{$i+1}}" value="ans{{$i+1}}"}} title="Mark this as the correct answer" required>
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