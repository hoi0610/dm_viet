<?php

namespace App\Http\Controllers;

use App\Comment;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai= TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=> $theloai]);
    }
    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
                ],
            [
                'Ten.required'=>'ban chua nhap ten the loai',
                'Ten.unique'=>'ten ban nhap bi trung ten',
                'Ten.min'=>'ten do dai gioi han tu 3 den 100 ki tu',
                'Ten.max'=>'ten do dai gioi han tu 3 den 100 ki tu'
            ]);
        $theloai->Ten = $request->Ten;
//        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','sua thanh cong');
    }
    public function getThem(){
        return view ('admin.theloai.them');

    }
    public function postThem(Request $request){
        $this->validate($request,
            ['ten'=>'required|min:3|max:50'],
            ['ten.required'=>'Ban chua nhap ten the loai',
                'ten.min'=>'ten the loai phai co do dai tu 3 den 100 ky tu',
                'ten.max'=>'ten the loai phai co do dai tu 3 den 100 ky tu',
                'ten.unique'=>'ten ban nhap bi trung ten'
                ]);
        $theloai = new Theloai;
//        dd($theloai);
        $theloai ->ten= $request->ten;
        $theloai->TenKhongDau =$request->TenKhongDau;
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','them thanh cong');
    }
    public function getXoa($id){
        $theloai = TheLoai::find($id);

        foreach ($theloai->loaitin()->get() as $loaitin)
        {
            $arr = $loaitin->tintuc()->pluck('id');
            Comment::whereIn('idTinTuc', $arr->toArray())->delete();
            $loaitin->tintuc()->delete();
        }
        $theloai->loaitin()->delete();
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Xoa thanh cong');
    }
}
