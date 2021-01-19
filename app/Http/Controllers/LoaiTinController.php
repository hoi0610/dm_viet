<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;
use App\LoaiTin;

class LoaiTinController extends Controller{
    public function getDanhSach(){
        $loaitin= LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem(){
        $theloai= TheLoai::all();
        return view ('admin.loaitin.them',['theloai'=>$theloai]);

    }
    public function postThem(Request $request){
            $this->validate($request,
                [
                'Ten'=>'required|unique:LoaiTin,Ten|min:1|max:100',
                    'TheLoai'=>'required'
            ],
                [
                'Ten.required'=>'ban chua nhap ten',
                'Ten.unique'=>'ten ban nhap bi trung',
                'Ten.min'=>'ten phai co do dai tu 1 den 100 ky tu',
                'Ten.max'=>'ten phai co do dai tu 1 den 100 ky tu',
                'TheLoai.require'=>'ban chua nhap ten the loai'
                ]);
            $loaitin = new Loaitin;
            $loaitin->Ten = $request->Ten;
            $loaitin->TenKhongDau =$request->TenKhongDau;
            $loaitin->idTheLoai = $request->TheLoai;
            $loaitin->save();
            return redirect('admin/loaitin/them')->with('thongbao','ban da them thanh cong');

    }
    public function getSua($id){
        $theloai= TheLoai::all();
        $loaitin =Loaitin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);

    }
    public function postSua(Request $request,$id){
        $this->validate($request,
            [
                'Ten'=>'required|unique:LoaiTin,Ten|min:1|max:100',
                'TheLoai'=>'required'
            ],
            [
                'Ten.required'=>'ban chua nhap ten',
                'Ten.unique'=>'ten ban nhap bi trung',
                'Ten.min'=>'ten phai co do dai tu 1 den 100 ky tu',
                'Ten.max'=>'ten phai co do dai tu 1 den 100 ky tu',
                'TheLoai.require'=>'ban chua nhap ten the loai'
            ]);
        $loaitin =LoaiTin::find($id);
        $loaitin->Ten =$request->Ten;
//        $loaitin->TenKhongDau=changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','ban da sua thanh cong');
    }

    public function getXoa($id)
    {
        $loaitin=LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','ban da xoa thanh cong');
    }
}
