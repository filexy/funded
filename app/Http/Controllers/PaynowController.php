<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paynow\Payments\Paynow;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class PaynowController extends Controller
{
    //
    public function pay(Request $request){
//_id=1&amount=&full_name=&email=&country=&postal_code=&comment=&payment_gateway=
        $campaign_id =$request->_id;
        $amount =$request->amount;
        $name=$request->full_name;
        $email=$request->email;
        $country=$request->country;
        $comment=$request->comment;

        DB::insert('insert into donations(campains_id,fullname,email,donation,country,comment,approved) 
VALUES(?,?,?,?,?,?,?)',[$campaign_id,$name,$email,$amount,$country,$comment,0]);

        $paynow = new Paynow(
            '9128',
            'b0e54d04-cd24-4e74-a060-2ea6d6e579de',
            'http://funded.co.zw/success/'.$campaign_id.'/'.$email,

            // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
            'http://funded.co.zw/paydonation/'.$campaign_id.'/'.$email

        );

        $payment = $paynow->createPayment(''.$campaign_id, ''.$email);
        $payment->add(''.$name, $amount);
        $response = $paynow->send($payment);




        $browserUrl = $response->redirectUrl();

        $message ="<a href='$browserUrl'> Paynow</a>";
       return Redirect::to(''.$browserUrl);

        // header("Location: http://www.geeksforgeeks.org");
        // Redirect the user to Paynow
        //$response->redirect();

        // Or if you prefer more control, get the link to redirect the user to, then use it as you see fit
        //$link = $response->redirectLink();





        // return url('https://felixitsolutions.com'.$request);
    }
}
