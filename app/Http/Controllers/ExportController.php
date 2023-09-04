<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Excel;
use App\Exports\UsersExport;

class ExportController extends Controller
{
    public function export(Excel $excel)
    {
        return $excel->download(new UsersExport, 'users.xlsx');
    }
}
