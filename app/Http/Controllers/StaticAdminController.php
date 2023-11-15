<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\school;
use App\Models\User;
use App\Models\Teatcher;
use Illuminate\Support\Facades\Auth;


class StaticAdminController extends Controller
{
    public function index()
    {
        $getAllSchool = school::all();
        return view('admin.index', [
            'titelPage' => 'الصفحة الرئيسئة',
            'getSchool' => $getAllSchool,
            'id' => Auth::id()
        ]);
    }

    public function settings()
    {
        return view('admin.SettingsAndProfile', [
            'titelPage' => 'الإعدادات'
        ]);
    }

    public function ActiveSchool()
    {
        $getActiveSchool = school::where('subscription', '>', date('Y-m-d'))->get();
        return view('admin.school.ActiveSchool', [
            'titelPage' => 'المدارس | النشطة',
            'getActiveSchool' => $getActiveSchool
        ]);
    }

    public function expirat()
    {
        $getExpiratSchool = school::where('subscription', '<=', date('Y-m-d'))->get();
        return view('admin.school.expirat', [
            'titelPage' => 'المدارس | الخاملة',
            'getExpiratSchool' => $getExpiratSchool

        ]);
    }
}
