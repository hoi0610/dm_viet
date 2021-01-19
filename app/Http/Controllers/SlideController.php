<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Slide;
use App\Http\Controllers\Request\SignupRequest;
class SlideController extends Controller
{
    public function getDanhSach()
    {
        $slide = Slide::all();
        return view('admin.slide.danhsach',compact('slide'));

    }
    public function getThem()
    {
        return view ('admin.slide.them');
    }
    public function postThem(Request $request)
    {
        $this->validate($request,[
                    'Ten'=>'required',
                    'NoiDung'=>'required',
                ],[
                    'Ten.required'=>'ban phai nhap ten',
                    'NoiDung.required'=>'ban phai nhap nd',
                ]);
                $slide = new Slide;
                $slide->Ten =$request->Ten;
                $slide->NoiDung = $request->NoiDung;
                if($request->has('link'))
                    $slide->link = $request->link;
                if ($request->hasFile('Hinh')) {
                    $file = $request->file('Hinh');
//                $duoi = $file->getClientOriginalExtension();
//                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
//                    return view('admin/tintuc/them')->with('thongbao', 'ban phai chon dung tep co duoi la JPG, PNG hoac JPEG');
//                }
                $name = $file->getClientOriginalName();
                $Hinh = $name;
////                while (file_exists("upload/slide/" . $Hinh)) {
//                    $Hinh = str_random(4) . "_" . $name;
//                }
                    $file->move('upload/slide',$Hinh);
                    $slide->Hinh = $Hinh;

            }else{
                    $slide->Hinh = "";
                };
                $slide->save();
                return redirect('admin/slide/them')->with('thongbao', 'them thanh cong');

        }

    public function getSua($id)
    {
        $slide =Slide::find($id);
        return view ('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request, $id)
    {
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required',
        ],[
            'Ten.required'=>'ban phai nhap ten',
            'NoiDung.required'=>'ban phai nhap nd',
        ]);
        $slide = Slide::find($id);
        $slide->Ten =$request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))
            $slide->link = $request->link;
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
//                $duoi = $file->getClientOriginalExtension();
//                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
//                    return view('admin/tintuc/them')->with('thongbao', 'ban phai chon dung tep co duoi la JPG, PNG hoac JPEG');
//                }
            $name = $file->getClientOriginalName();
            $Hinh = $name;
////                while (file_exists("upload/slide/" . $Hinh)) {
//                    $Hinh = str_random(4) . "_" . $name;
//                }
            unlink('upload/slide/'.$slide->Hinh);
            $file->move('upload/slide',$Hinh);
            $slide->Hinh = $Hinh;

        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao', 'sua thanh cong');
    }
    public function getXoa($id)
    {
        $slide = Slide::find($id);
        $slide -> delete();
        return view('admin/slide/danhsach')->with('thongbao','xoa thanh cong');
    }
}
