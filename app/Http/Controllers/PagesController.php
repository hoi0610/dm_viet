<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use Illuminate\Support\Facades\Auth;
class PagesController extends Controller
{
    public function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
//        if(Auth::check()) {
////            view()->share('nguoidung', Auth::user());
//        }
    }

    public function menu(){
        return view('pages.trangchu');
    }
    public function Lienhe(){

        return view('pages.lienhe');
    }
    public function loaitin($id){
        $loaitin =LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view ('pages.loaitin',compact('loaitin','tintuc'));

    }
    public function tintuc($id){
        $tintuc = TinTuc::find($id);
        $noibat = TinTuc::where('NoiBat',1)->take(5)->get();
        $lienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(5)->get();
        return view ('pages.tintuc',compact('tintuc','noibat','lienquan'));
    }
    public function getDangnhap(){
        return view ('pages.dangnhap');
    }
    public function postDangnhap(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32',
        ],[
            'email.required'=>'Ban phai nhap email',
            'password.required'=>'Ban chua dien password',
            'password.min'=>'Mật khẩu phải có từ 3 đến 32 ký tự',
            'password.max'=>'Mật khẩu phải có từ 3 đến 32 ký tự'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('trangchu');
        }else{
            return redirect('dangnhap')->with('thongbao','Sai Email hoặc password');
        }
    }
    public function getDangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }
    function getNguoidung(){
        $user = Auth::user();
        return view ('pages.nguoidung',compact('user'));
    }
    function postNguoidung(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3',
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],[
            'name.required'=>'ban chua nhap ten ng dung',
            'name.min'=>'ten nguoi dung phai co it nhat 3 ky tu',
            'password.required'=>' ban chua nhap mat khau',
            'password.min|max'=>'mat khau phai co tu 3 ky tu den 32 ky tu',
            'password.passwordAgain'=>'ban chua nhap lai mat khau',
            'passwordAgain.same'=>'mat khau nhap lai chua trung nhau'
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('nguoidung')->with('thongbao','Sửa thành công');
    }
    public function getDangky(){
        return view ('pages.dangky');
    }

    public function postDangky(Request $request){
        $this->validate($request,[
            'name'=>'required|min:3|max:32',
            'email'=>'required:min:3|max:32',
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],[
            'name.required'=>'Bạn chưa nhập tên',
            'email.required'=>'Bạn phải nhập email',
            'password.required'=>'Bạn phải nhập email',
            'name.min'=>'Tên phải có từ 3 đến 32 ký tự',
            'name.max'=>'Tên phải có từ 3 đến 32 ký tự',
            'password.min'=>'Tên phải có từ 3 đến 32 ký tự',
            'password.max'=>'Tên phải có từ 3 đến 32 ký tự',
            'passwordAgain.same'=>'Password không trùng nhau',

        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email =$request->email;
        $user->password= bcrypt($request->password);
        $user->quyen = 0;
        $user ->save();
        return redirect('dangnhap')->with('thongbao','Đăng ký tài khoản thành công');
    }
    public function Timkiem(Request $request){
        $tukhoa=$request->tukhoa;
        $tintuc= TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->orwhere('NoiDung','like',"%$tukhoa%")->take(20)->paginate(4);
        return view('pages.timkiem',compact('tukhoa','tintuc'));
    }

}
