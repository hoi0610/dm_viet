@extends('layout.index')
@section('content')
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Trần Hồi</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span>{{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                    {!! $tintuc->NoiDung !!}
                </p>
                <hr>
                @if(session('thongbao'))
                    {{session('thongbao')}}
                <!-- Blog Comments -->
                @endif
                <!-- Comments Form -->
                @if(auth()->user())
                    <div class="well">
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form action="comment/{{$tintuc->id}}" role="form" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                @endif
                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $tt)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$tt->user->name}}
                            <small>{{$tt->created_at}}</small>
                        </h4>
                        {{$tt->NoiDung}}
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach($lienquan as $lq)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$lq->id}}/{{$lq->NoiDung}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$lq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$lq->id}}/{{$lq->TieuDeKhongDau}}.html"><b>{{$lq->TieuDe}}</b></a>
                            </div>
                            <p>{{$lq->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach($noibat as $nb)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$nb->Hinh}}" alt="">
                                </a>

                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html"><b>{{$nb->TieuDe}}</b></a>
                            </div>
                            <p>{{$nb->TomTat}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
@endsection