<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanDetailsController extends Controller
{
    public function index()
    {
        // Retrieve loan details from the database
        $loanDetails = DB::table('loan_details')->get();

        // Pass loan details to the view
        return view('loan.index', compact('loanDetails'));
    }
}
