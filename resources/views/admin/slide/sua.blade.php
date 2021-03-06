@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>{{$slide->Ten}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
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
                    <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" placeholder="Nhập tên slide" value="{{$slide->Ten}}"/>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea id="demo" class="form-control ckeditor" rows="4" name="NoiDung" value="{{$slide->NoiDung}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <textarea name="link" id="" value="{{$slide->link}}"></textarea>
                        </div>
                        <div class="form-group">

                            <label>Hình Ảnh</label>
                            <p>
                                <img scr="upload/slide/{{$slide->Hinh}}">
                            </p>
                            <input type="file" name="Hinh">
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm Mới</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection