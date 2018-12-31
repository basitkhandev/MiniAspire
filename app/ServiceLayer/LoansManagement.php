<?php
namespace App\ServiceLayer;
use App\IntrestRate;
use App\ArrangmentFee;
Use App\RepaymentFrequency;
use App\UsersLoan;
use App\UsersRepayment;
use Exception,Log;
class LoansManagement {

    public function __construct(){

    }
    public function calculate($request,$action){
        try{
            $userid = $request->user()->id;
            $loan_amount = $request->loan_amount;
            $interest_rate_obj = IntrestRate::first();
            $arrangement_fee_obj = ArrangmentFee::first();
            $frequency_object = RepaymentFrequency::where("frequency_id",$request->frequency_id)->first();
            $loan_duration = $request->duration;
            $response = $this->applyLoan($userid,$loan_amount,$interest_rate_obj,$arrangement_fee_obj,$frequency_object,$loan_duration,$action);
            if(is_array($response))
                return response()->json($response, 200);
            else
                return $response;
        }catch (Exception $e)
        {
            return response()->json([
            'message' => 'Something went wrong. Please try again later',
            ], 500);
        }
    }

    public function applyLoan($userid,$loan_amount,$interest_rate_obj,$arrangement_fee_obj,$frequency_object,$loan_duration,$action){
        try{
        ////applying calculations here
        $frequency = $frequency_object->frequency_name;
        $interest_rate = $interest_rate_obj->interest_ratio;
        $arrangement_fee = $arrangement_fee_obj->fee;
        $loan_interest = ($loan_amount*$interest_rate)/100;

        $total_outstanding = $loan_amount+$loan_interest+$arrangement_fee;

        switch ($frequency) {
            case "Monthly":
                $total_installments = $loan_duration;
        break;
            case "Quarterly":
                if($loan_duration%3 > 0)
                    $total_installments = floor($loan_duration/3)+1;
                else
                    $total_installments = ($loan_duration/3);
        break;
            case "Semi Annually":
                if($loan_duration%6 > 0)
                    $total_installments = floor($loan_duration/6)+1;
                else
                    $total_installments = ($loan_duration/6);
        break;
                case "Annually":
                if($loan_duration%12 > 0)
                    $total_installments = floor($loan_duration/12)+1;
                else
                    $total_installments = ($loan_duration/12);
        break;
            default:
                $total_installments = $loan_duration;
        }

        $repayments = $total_outstanding/$total_installments;
        $repayments = number_format((float)$repayments, 2, '.', '');
        if($action == "calculate")
        {
            return [
                'Fee' => $arrangement_fee,
                'Interest Rate(%)' => $interest_rate,
                'Loan interest' => $loan_interest,
                'Number of Installments' => $total_installments,
                'Repayments' => $repayments,
                'Total Outstanding' => $total_outstanding
            ];
        }else
        {
            return $this->saveLoan($userid,$loan_amount,$interest_rate_obj,$arrangement_fee_obj,$frequency_object,$loan_duration,$repayments,$total_installments);
        }
    }catch (Exception $e)
        {
        return response()->json([
        'message' => 'Something went wrong. Please try again later',
        ], 500);
        }
    }

    public function saveloan($userid,$loan_amount,$interest_rate_obj,$arrangement_fee_obj,$frequency_object,$loan_duration,$repayments,$total_installments){
        /////save loan info of the user
        $input = [
            'user_id_fk' => $userid,
            'loan_amount'=>$loan_amount,
            'interest_rate_id_fk'=>$interest_rate_obj->interest_rate_id,
            'arrangement_fee_id_fk'=>$arrangement_fee_obj->arrangement_fee_id,
            'repayment_frequency_id_fk'=>$frequency_object->frequency_id,
            'duration'=>$loan_duration
        ];
        $loan = UsersLoan::create($input);
        $load_id = $loan->id;
        ////save repayments of according to the load plan
        for($i=1; $i <= $total_installments; $i++ )
        {
            $repayment_obj = new UsersRepayment;
            $repayment_obj->user_id_fk = $userid;
            $repayment_obj->users_loans_fk =$load_id;
            $repayment_obj->users_payable_payments = $repayments;
            $repayment_obj->save();
        }
        return response()->json([
            'message' => 'User loan has been created successfully.',
        ], 200);

    }
    public function payRepayment($request){

        try{
        $repayment = UsersRepayment::where('id',$request->user_repayments_id)->first();

        if($repayment->users_payable_payments == $request->amount && $repayment->status != "paid")
        {
            $repayment->status = "paid";
            $repayment->save();
            return response()->json([
                'message' => 'Repayment has been paid successfully.',
            ], 200);
        }
        else if($repayment->status == "paid")
            return response()->json([
                'message' => 'This repayment already has been paid.',
            ], 302);
        else if($repayment->users_payable_payments != $request->amount)
        {
            return response()->json([
                'message' => 'Repayment amount does not match with the loan repayments amount.',
            ], 402);
        }
    }catch (Exception $e)
    {
    Log::error($e);
    return response()->json([
    'message' => 'Something went wrong. Please try again later',
    ], 500);
    }
    }

}