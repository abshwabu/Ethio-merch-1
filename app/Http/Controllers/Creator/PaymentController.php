<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\CreatorPaymentData;
use Illuminate\Http\Request;
use App\Models\Creator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function payment_data()
    {
        if (Creator::where('user_id', Auth::user()->id)->exists()) {

            $title = 'payment data';
            $creator = Creator::where('user_id', Auth::user()->id)->first();
            $bank = Creator::where('user_id', Auth::user()->id)->with(
                ['payment' => function ($query) {
                    $query->where('method', 'bank');
                }]
            )->first();
            // $bank = json_decode(json_encode($bank),true);
            // echo "<pre>" ; print_r($bank) ; die ;
            $telebirr = Creator::where('user_id', Auth::user()->id)->with(
                ['payment' => function ($query) {
                    $query->where('method', 'telebirr');
                }]
            )->first();
            // $telebirr = json_decode(json_encode($telebirr),true);
            // echo "<pre>" ; print_r($telebirr) ; die ;
            return view('creator.account.payment-data', compact('title', 'bank', 'telebirr', 'creator'));
        } else {
            return redirect('creator/personal-information')->with('error', 'please first complete your profile');
        }
    }
    public function add_edit_payment(Request $request, $id)
    {
        //update payment (bank)
        if (CreatorPaymentData::where('creator_id', $id)->where('method', 'bank')->exists()) {
            $message = "payment data updated success fully";
            if ($request->method == "bank") {

                $payment = CreatorPaymentData::where('creator_id', $id)->where('method', 'bank')->first();
                $data = $request->all();

                $request->validate([
                    "account_holder_bank" => 'required',
                    "account_number" => 'required',
                    "bank_name" => 'required'
                ]);

                $payment->creator_id = $id;
                $payment->account_holder = $data['account_holder_bank'];
                $payment->account_number = $data['account_number'];
                $payment->bank_name = $data['bank_name'];
                $payment->method = $data['method'];
                $payment->update();
            }
        }
        //update payment (telebirr)
        if (CreatorPaymentData::where('creator_id', $id)->where('method', 'telebirr')->exists()) {
            if ($request->method == "telebirr") {

                $payment = CreatorPaymentData::where('creator_id', $id)->where('method', 'telebirr')->first();

                $data = $request->all();
                $data = json_decode(json_encode($data), true);
                // echo "<pre>" ; print_r($data) ; die ;
                $request->validate([
                    "phone_number" => ['required','numeric', 'digits:10', Rule::unique('creators', 'phone_number')->ignore($request->id)],
                    "account_holder_telebirr" => 'required',
                ]);

                $payment->creator_id = $id;
                $payment->account_holder = $data['account_holder_telebirr'];
                $payment->phone_number = $data['phone_number'];
                $payment->method = $data['method'];
                $payment->update();
            }
        }
        //new payment data
        else {

            $payment = new CreatorPaymentData;
            $message = "payment data added successfully";


            //for bank
            if ($request->method == "bank") {

                $data = $request->all();
                $data = json_decode(json_encode($data), true);
                // echo "<pre>";
                // print_r($data);
                // die;
                $request->validate([
                    "account_holder_bank" => 'required',
                    "account_number" => 'required',
                    "bank_name" => 'required'
                ]);

                $payment->creator_id = $id;
                $payment->account_holder = $data['account_holder_bank'];
                $payment->account_number = $data['account_number'];
                $payment->bank_name = $data['bank_name'];
                $payment->method = $data['method'];
                $payment->save();
            }
            //for telebirr
            else {
                $data = $request->all();
                $data = json_decode(json_encode($data), true);
                // echo "<pre>";
                // print_r($data);
                // die;
                $request->validate([
                    "phone_number" => ['required','numeric', 'digits:10', Rule::unique('creators', 'phone_number')->ignore($request->id)],
                    "account_holder_telebirr" => 'required',
                ]);

                $payment->creator_id = $id;
                $payment->account_holder = $data['account_holder_telebirr'];
                $payment->phone_number = $data['phone_number'];
                $payment->method = $data['method'];
                $payment->save();
            }
        }
        session()->flash('success', $message);
        return redirect('creator/dashboard');
    }
}
