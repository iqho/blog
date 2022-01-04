<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(){
        
        $isAdmin = Auth()->user()->user_type == 1;
        $isEditor = Auth()->user()->user_type == 2;
        $isAuthor = Auth()->user()->user_type == 3;
        $isContributor = Auth()->user()->user_type == 4;
        return view('dashboard', compact('isAdmin', 'isEditor', 'isAuthor', 'isContributor'));
    }
}