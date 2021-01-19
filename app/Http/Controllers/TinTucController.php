<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Tintuc;
use App\TheLoai;
use App\LoaiTin;
use App\Http\Controllers\Request\SignupRequest;
class TinTucController extends Controller
{
    public function getDanhSach()
    {
        $tintuc=TinTuc::all();
        return view('admin.tintuc.danhsach',compact('tintuc'));
    }
    public function getThem()
    {
        $theloai= TheLoai::all();
        $loaitin = LoaiTin::all();
        return view ('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
            'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
            ],[
                'LoaiTin.required'=>'ban phai nhap loai tin',
                'TieuDe.required'=>'ban phai nhap tieu de',
                'TieuDe.unique'=>'tieu de ban nhap bi trung',
                'TieuDe.min'=>'ten tieu de phai tu 3 den 100 ky tu',
                'NoiDung.required'=> 'ban phai nhap nd',
                'TomTat.required'=>'ban phai nhap tom tat'
            ]);
            $TinTuc= new TinTuc;
            $TinTuc->TieuDe =$request->TieuDe;
            $TinTuc->TieuDeKhongDau= $request->TieuDeKhongDau;
            $TinTuc->TomTat= $request->TomTat;
            $TinTuc->NoiDung =$request->NoiDung;
            if($request->hasFile('Hinh')){
                $file=$request->file('Hinh');
                $Hinh = $file->getClientOriginalName();
                $file->move('upload/tintuc',$Hinh);
                $TinTuc->Hinh= $Hinh;
            }else{
                $TinTuc->Hinh="";
            };
            $TinTuc->noibat = $request->NoiBat;
//            $TinTuc->Loaitin =$request->LoaiTin;
            $TinTuc->idLoaiTin = $request->LoaiTin;




            $TinTuc->save();
            return redirect('admin/tintuc/them')->with('thongbao','them tin thanh cong');
    }
    public function getSua($id)
    {

        $theloai =TheLoai::all();
        $loaitin =LoaiTin::all();
        $tintuc= TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request, $id)
    {
        if($request->hasFile('Hinh')){
            $this->validate($request,
                [
                    'LoaiTin'=>'required',
                    'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                    'TomTat'=>'required',
                    'NoiDung'=>'required'
                ],[
                    'LoaiTin.required'=>'ban phai nhap loai tin',
                    'TieuDe.required'=>'ban phai nhap tieu de',
                    'TieuDe.unique'=>'tieu de ban nhap bi trung',
                    'TieuDe.min'=>'ten tieu de phai tu 3 den 100 ky tu',
                    'NoiDung.required'=> 'ban phai nhap nd',
                    'TomTat.required'=>'ban phai nhap tom tat'
                ]);
                $TinTuc = TinTuc::find($id);
                $TinTuc->TieuDe =$request->TieuDe;
    //            $TinTuc->TenKhongDau=changeTitle($request->TieuDe);
                $TinTuc->idLoaiTin = $request->LoaiTin;
                $TinTuc->TomTat= $request->TomTat;
                $TinTuc->NoiDung =$request->NoiDung;
                if($request->hasFile('Hinh')){
                    $file=$request->file('Hinh');
                    $name=$file->getClientOriginalName();
                    $Hinh =str_random(4)."_".$name;
                    unlink('upload/tintuc/'.$TinTuc->Hinh);
                    $file->move('upload/tintuc',$Hinh);
                    $TinTuc->Hinh-=$Hinh;
                }
                $TinTuc->save();
                return redirect('admin/tintuc/sua/'.$id)->with('thongbao','sua thanh cong');
            }

    }
    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete($id);
        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xoa thanh cong');

    }
}
