<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServiceLayer\LoansManagement;

class LoansController extends Controller
{
    private $loanManage;

    public function __construct(){
        $this->loanManage = new LoansManagement();
    }
    public function calculate(Request $request)
    {
            $this->validate($request, [
                'loan_amount' => 'required|numeric',
                'frequency_id' => 'required|numeric',
                'duration' => 'required|numeric'
            ]);
            return $this->loanManage->calculate($request,"calculate");
    }

    public function create(Request $request)
    {
            $this->validate($request, [
                'loan_amount' => 'required|numeric',
                'frequency_id' => 'required|numeric',
                'duration' => 'required|numeric'
            ]);
            return $this->loanManage->calculate($request,"create");
    }

    public function payRepayment(Request $request)
    {
            $this->validate($request, [
                'amount' => 'required|numeric',
                'user_repayments_id' => 'required|numeric'
            ]);
            return $this->loanManage->payRepayment($request);
    }

}
