<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Paymentmethod;
use App\Models\Transaction;
use Illuminate\Http\Request;
class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $paymentmethod = Paymentmethod::where('vendor_id',1)->get();
        return view('admin.payments.payments', compact('paymentmethod'));
    }
    public function paymentmethod(Request $request)
    {
        $transaction_type = $request->transaction_type;
        $status = $request->status;
        $environment = $request->environment;
        $public_key = $request->public_key;
        $secret_key = $request->secret_key;
        foreach($transaction_type as $key => $no){
            $data = Paymentmethod::find($no);
            if(!empty($status)){
                if(isset($status[$no])){
                    $data->is_available = $status[$no];
                }else{
                    $data->is_available = 2;
                }
            }else{
                $data->is_available = 2;
            }
            if(in_array($no,[3,4,5,6])){
                $data->environment = $environment[$no];
                $data->public_key = $public_key[$no];
                $data->secret_key = $secret_key[$no];
            }
            if($no == 5){
                $data->encryption_key = $request->encryption_key;
            }
            $data->save();
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function transaction(Request $request)
    {
        $transaction = Transaction::with('plans_info','users_info','paymentmethod_info')->get();
        return view('admin.transaction.transaction', compact('transaction'));
    }
}
