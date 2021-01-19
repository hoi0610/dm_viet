<?php

namespace App\Http\Controllers;

use App\User;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportController extends Controller implements FromCollection,WithHeadings
{
    use Exportable;

    public function collection()
    {
        $theloai = User::take(5)->get();
        foreach ($theloai as $row) {
            $theloai[] = array(
                '0' => $row->id,
                '1' => $row->name,
                '2' => $row->quyen,
                '3' => $row->email,
                '4' => $row->password,
            );
        }
        return (collect($theloai));
    }

    public function headings(): array
    {
        return [
            'Id',
            'Ten',
            'Quyen',
            'Email',
            'Matkhau'
        ];
    }

    public function Export()
    {
        return Excel::download(new ExportController(), 'Users.csv');
    }
}

