<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getDanhSach()
    {
        $user = User::all();
        return view('admin.users.danhsach',compact('user'));

    }
    public function getThem()
    {
        return view('admin.users.them');
    }
    public function postThem(Request $request)
    {
        $this->validate($request,[
            'ten'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],[
            'ten.required'=>'ban chua nhap ten ng dung',
            'ten.min'=>'ten nguoi dung phai co it nhat 3 ky tu',
            'email.required'=> 'ban chua nhap email',
            'email.email'=>'ban chua nhap dung dinh dang email',
            'email.unique'=>'email da ton tai',
            'password.required'=>' ban chua nhap mat khau',
            'password.min|max'=>'mat khau phai co tu 3 ky tu den 32 ky tu',
            'password.passwordAgain'=>'ban chua nhap lai mat khau',
            'passwordAgain.same'=>'mat khau nhap lai chua trung nhau'
        ]);
        $user = new User;
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->quyen = $request->quyen;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/user/them')->with('thongbao','them thanh cong');
    }

    public function getSua($id)
    {
        $user = User::find($id);
        return view ('admin/users/sua',compact('user'));


    }
    public function postSua(Request $request, $id)
    {
        $this->validate($request,[
            'ten'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:32',
            'passwordAgain'=>'required|same:password'
        ],[
            'ten.required'=>'ban chua nhap ten ng dung',
            'ten.min'=>'ten nguoi dung phai co it nhat 3 ky tu',
            'email.required'=> 'ban chua nhap email',
            'email.email'=>'ban chua nhap dung dinh dang email',
            'email.unique'=>'email da ton tai',
            'password.required'=>' ban chua nhap mat khau',
            'password.min|max'=>'mat khau phai co tu 3 ky tu den 32 ky tu',
            'password.passwordAgain'=>'ban chua nhap lai mat khau',
            'passwordAgain.same'=>'mat khau nhap lai chua trung nhau'
        ]);
        $user = User::find($id);
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->quyen = $request->quyen;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','sua thanh cong');
    }
    public function getXoa($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao',' xoa nguoi dung thanh cong');
    }
    public function getDangnhapAdmin(){
        return  view('admin.login');
    }
    public function postDangnhapAdmin(Request $request){
            $this->validate($request,[
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],[
                'email.required'=>'Bạn cần nhập email',
                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max'=>'Mật khẩu không được nhiều hơn 32 ký tự'
            ]);
            if (Auth::attempt(['email'=> $request -> email,'password'=>$request->password])){
                return redirect('admin/theloai/danhsach');
            }else{
                return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
            }
    }
    public function LogOut(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
