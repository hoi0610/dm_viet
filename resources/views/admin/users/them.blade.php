@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Thêm</small>
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
                    <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Họ Tên</label>
                            <input class="form-control" name="ten" placeholder="Nhập họ tên" />

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Nhập email" type="email"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Nhập password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Nhap lai pass</label>
                            <input type="password" name="passwordAgain" placeholder="Nhập lại password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Quyền người dùng</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" checked="" type ="radio">Admin
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="0" type="radio">Khách
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Thêm </button>
                        <button type="reset" class="btn btn-default">Làm Mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // $(document).ready(function () {
        //     $("#TheLoai").change(function () {
        //         var idTheLoai =$(this).val();
        //         $.get("admin/ajax/loaitin/"+idTheLoai,function (data){
        //             $("#LoaiTin").html(data);
        //         })
        //     })
        // })
    </script>
@endsection