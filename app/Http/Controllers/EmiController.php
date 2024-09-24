<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmiController extends Controller
{


  
    public function show(Request $request)
{
   
    if ($request->session()->has('success')) {
        // Retrieve the EMI details from the database
        $emiDetails = DB::table('emi_details')->get();
    } else {
        // If not processed yet, keep it empty
        $emiDetails = [];
    }
    
    return view('emi.process', compact('emiDetails'));
}


    public function processEmi()
    {

       // dd("code coming");
        $minDate = DB::table('loan_details')->min('first_payment_date');
        $maxDate = DB::table('loan_details')->max('last_payment_date');

        $months = $this->generateMonthColumns($minDate, $maxDate);

        DB::statement('DROP TABLE IF EXISTS emi_details');

        $this->createEmiDetailsTable($months);

        $loanDetails = DB::table('loan_details')->get();
        foreach ($loanDetails as $loan) {
            $this->insertEmiDetails($loan, $months);
        }

        return redirect()->back()->with('success', 'EMI details processed successfully.');
    }

    private function generateMonthColumns($minDate, $maxDate)
    {
        $start = \Carbon\Carbon::parse($minDate);
        $end = \Carbon\Carbon::parse($maxDate);
        $months = [];

        while ($start->lte($end)) {
            $months[] = $start->format('Y_M');
            $start->addMonth();
        }

        return $months;
    }

    private function createEmiDetailsTable($months)
    {
        $columns = implode(", ", array_map(function($month) {
            return "$month DECIMAL(10, 2) DEFAULT 0";
        }, $months));

        DB::statement("CREATE TABLE emi_details (
            clientid INT,
            $columns
        )");
    }

    private function insertEmiDetails($loan, $months)
    {
        $emi = $loan->loan_amount / $loan->num_of_payment;
        $data = ['clientid' => $loan->clientid];

        foreach ($months as $index => $month) {
            if ($index < $loan->num_of_payment) {
                $data[$month] = number_format($emi, 2);
            } else {
                $data[$month] = 0.00;
            }
        }

        if ($loan->num_of_payment > 0) {
            $totalEmi = $emi * $loan->num_of_payment;
            $lastMonth = end($months);
            $adjustedValue = $loan->loan_amount - ($totalEmi - $emi);
            $data[$lastMonth] = number_format($adjustedValue, 2);
        }

        DB::table('emi_details')->insert($data);
    }
}
