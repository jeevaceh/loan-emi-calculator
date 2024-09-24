<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
       // dd(auth()->user());
        // Check if the user is authorized
         if (auth()->user()) {
        $loanDetails = DB::table('loan_details')->get();
        return view('admin.index', compact('loanDetails'));
        }else{
            return redirect('/')->with('error', 'Unauthorized Access');
        }

   
       
    }
}
