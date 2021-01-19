@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>{{$user->name}}</small>
                    </h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors ->all() as $err)
                                {{$err}}<br>
                            @endforeach()
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-danger">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <form action="admin/user/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Họ Tên</label>
                            <input class="form-control" name="ten" placeholder="Nhập họ tên" value="{{$user->name}}"/>

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Nhập email" type="email" value="{{$user->email}}"/>
                        </div>
                        <div class= "form-group">

                            <label>Change Password</label>
                            <input type="password"   name="password" placeholder="Nhập password" class="form-control password"/>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại pass</label>
                            <input type="password"  name="passwordAgain" placeholder="Nhập lại password" class="form-control password"/>
                        </div>
                        <div class="form-group">
                            <label>Quyền người dùng</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1"
                                       @if($user->quyen==1)
                                            {{'checker'}}
                                               @endif
                                       checked="" type ="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="0"
                                       @if($user->quyen==0)
                                            {{'checker'}}
                                       @endif
                                       type="radio">Khách
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm Mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
            $(document).ready(function(){
                $("#changePassword").change(function(){
                  if($(this).is(":checked")){
                      $(".form-control password").removeAttr('disabled')
                  }else{
                      $(".form-control password").attr('disabled','');
                  }
                });
            });
    </script>
@endsection