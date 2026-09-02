<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class StaffController extends Controller
{

    public function staffInformation()
    {
        return view('admin.staff.staff_information');
    }

    public function staffArchives()
    {
        return view('admin.staff.staff_archives');
    }
}