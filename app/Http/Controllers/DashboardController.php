<?php

namespace App\Http\Controllers;

use App\Models\Certificados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('student')){

            $data = Certificados::where('user_id', Auth::user()->id)->get();
            $totalhoras = Certificados::where('status', 1)
                                        ->where('user_id', Auth::user()->id)
                                        ->sum('horas');

            return view('userdashboard', compact('data','totalhoras'));

        }elseif(Auth::user()->hasRole('admin')){

            $data = Certificados::paginate(10);

            return view('adminDashBoard', compact('data'));
        }
    }
}
