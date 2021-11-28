<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body class="hold-transition sidebar-mini">
    @section('header')
        <header id="header-entercode">
            <a href="/" class="logo"><img src="../image/logo.jpg" alt=""></a>
            <ul id="ul-header-entercode">
                <li id="li-header-entercode"><a id="entercode" href="/entercode">Enter code</a></li>
            </ul>
        </header>
    @endsection

    @yield('header')

    <section class="content section-top">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manage Detail</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Number of rooms</span>
                        <span class="info-box-number text-center text-muted mb-0">{{count($rooms)}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Total players were played</span>
                        <span class="info-box-number text-center text-muted mb-0">120</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Estimated room</span>
                        <span class="info-box-number text-center text-muted mb-0">20</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <h4>List of room</h4>
                    
                    @if(count($rooms)>0)
                        @foreach ($rooms as $room)
                            <br>
                            <div class="post">
                                <div class="user-block">
                                  <img class="img-circle img-bordered-sm" src="{{$room['imageUrl'] == 'null' ? '../image/logo.jpg' : $room['imageUrl']}}" alt="user image">
                                  <span class="username">
                                    <a href="/manageroom/{{$room['idroom']}}">{{$room['title']}}</a>
                                  </span>
                                  <span class="description">{{$room['ispublic'] ? 'Public' : 'Not public'}}</span>
                                </div>
                                <!-- /.user-block -->
                                <p>{{$room['desription']}}</p>
                                <p>
                                  <a href="/manageroom/{{$room['idroom']}}" class="link-black text-sm"><i class="fas fa-edit mr-1"></i> Edit questions for room</a>
                                </p>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="public" name="public" value="{{$room['idroom']}}" {{ $room['ispublic'] ? 'checked' : ''}}>
                                    <label class="form-check-label" for="public" >Public</label>
                                </div>
                                <a type="button" class="btn btn-primary {{sizeof($room['data']) > 0 ? '' : 'disabled'}}" href="/host/{{$room['idroom']}}">Open room</a>
                                <button type="button" class="btn btn-danger" onclick="deleteRoom({{$room['idroom']}})">Delete room</button>
                                @if (sizeof($room['data']) <= 0)
                                    <small class="form-text text-muted">Please add some questions to open this room</small>                                    
                                @endif
                            </div>
                        @endforeach
                    @else
                        <b>Khong co cai room nao het</b>
                    @endif

                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Manage your rooms </h3>
                <p class="text-muted">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                <br>
                <div class="text-muted">
                  <p class="text-sm">User Name
                    <b class="d-block">{{$data['username']}}</b>
                  </p>
                  <p class="text-sm">Type of user
                    <b class="d-block">{{ucfirst($data['type'])}}</b>
                  </p>
                </div>
                <div class="text-center mt-5 mb-3">
                  <button class="btn btn-sm btn-primary" onclick="onShowContainer()">Create new room</button>
                  <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                  <a href="/signout" class="btn btn-sm btn-danger">Sign out</a>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>

      <section class="content">
        <div class="card">
            
          <div class="card-header">
            <h3 class="card-title">Room in library</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
                <div class="row d-flex justify-content-center">
                    @foreach ($allroom as $room)
                        @if ($room['ispublic'])
                                <div class="card col-lg-3 m-2">
                                <img class="card-img-top card-public" src="{{$room['imageUrl'] != 'null' ? $room['imageUrl'] : '../image/logo.jpg'}}" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">{{$room['desription']}}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
          </div>
        </div>
      </section>
      <!-- Add new room -->
      <div class="container-add-room invisible" id="container-add-room">
        <section>
            <div>
                <form action="{{$url}}/createnewroom" method="get">                  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name of room</label>
                        <input type="text" class="form-control" id="nameroom" aria-describedby="nameRoomHelp" placeholder="Enter name of room" name="nameroom">
                        <small id="nameRoomHelp" class="form-text text-muted">This is name for room of you, you can change after created.</small>
                    </div>
                    <div class="form-group">
                        <label for="descriptionroom">Enter description of room</label>
                        <textarea type="text" class="form-control textarea-none-resize" id="descriptionroom" placeholder="Enter description of room" name="description" rows="5" required></textarea>
                    </div>
                    <input type="text" class="invisible d-none" value="{{$data['id']}}" name="iduser">
                    <button type="submit" class="btn btn-primary d-block mx-auto">Save</button>
                </form>
                <button class="btn btn-primary mt-3" onclick="onHideContainer()">Cancel</button>
            </div>
        </section>
    </div>

    @include('foot')
    <script src="../../js/admin.js"></script>
    <script src="../../js/adminv-2.js"></script>
</body>
</html>