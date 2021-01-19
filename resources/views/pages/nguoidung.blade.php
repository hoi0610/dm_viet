@extends('layout.index')
@section('content')
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Thông tin tài khoản</div>
                    <div class="panel-body">
                        @if(session('thongbao'))
                            <div class="alert alert-danger">
                            {{session('thongbao')}}
                            </div>
                            @endif
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $er)
                                    {{$er}}<br>
                                    @endforeach
                            </div>
                            @endif
                        <form action="nguoidung" method="post">
                            @csrf
                            <div>
                                <label>Họ tên</label>
                                <input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{$user->name}}">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input type="email" readonly value="{{$user->email}}" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
                                       disabled
                                >
                            </div>
                            <br>
                            <div>
                                <label>Mật Khẩu</label>
                                <input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-default">Sửa
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    @endsection
