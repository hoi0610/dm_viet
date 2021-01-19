@extends('layout.index')
@section('content')
<div class="container">

    @include('layout.slide')
    <div class="space20"></div>
    <div class="row main-left">
            @include('layout.menu')
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                    <h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
                </div>

                <div class="panel-body">
                    <!-- item -->
                    <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

                    <div class="break"></div>
                    <h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                    <p>Thôn 6 Đình Xuyên, Gia Lâm Hà Nội</p>

                    <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                    <p>hoi06101994@gmail.com </p>

                    <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                    <p>0369562544 </p>



                    <br><br>
                    <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                    <div class="break"></div><br>
                    <iframe src="https://www.google.com/maps/place/%C4%90%C3%ACnh+Xuy%C3%AAn,+Gia+L%C3%A2m,+H%C3%A0+N%E1%BB%99i/@21.0766596,105.9177123,14z/data=!3m1!4b1!4m5!3m4!1s0x3135a83a711be4b7:0x4207604213b21d29!8m2!3d21.0760486!4d105.936207" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
    @endsection



