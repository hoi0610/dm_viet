<?php

namespace App\Http\Controllers;
use App\User;
use Excel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportController extends Controller implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
//        dd($row);
        return new User([
            'id'=>$row['id'],
            'name' =>$row['ten'],
            'quyen'=>$row['quyen'],
            'email'=>$row['email'],
            'password'=>Hash::make($row['matkhau']),
        ]);
    }
    public function import(){
        Excel::import(new ImportController(),request()->file('file'));
        return back();
    }
}

