<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaymentController extends Controller
{
    public function pay(){
        $checkOutData = $this->datos_pago(); 
        
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($checkOutData);
        return redirect($response['paypal_link']); 
        
    }
    public function datos_pago(){
        $cartItems = [
            [
                'name' => 'Producto 1',
                'price' => '20',
                'desc'  => 'Descripción 1',
                'qty' => 1,
            ],
            [
                'name' => 'Producto 2',
                'price' => '10',
                'desc'  => 'Descripción 2',
                'qty' => 1,
            ],
        ];
        $total = 30;
        $checkOutData = [
            'items' => $cartItems,
            'invoice_id' => uniqid(),
            'invoice_description' => 'Pago de curso tal',
            'return_url' => url('successpaypal'),
            'cancel_url' => url('cancelpaypal'),
            'total' => $total,
            // 'shipping_discount' => $total*0.2,
        ];
        return $checkOutData;
    }

    public function success(Request $request)
    {
        $checkOutData = $this->datos_pago();

        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING'])) {
            $payment_status = $provider ->doExpressCheckoutPayment($checkOutData, $request->token, $request->PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            if (in_array($status,['Completed','Processed'])) { 
                // dd($response);
                $payment = new Payment();
                $payment->mount = $checkOutData['total'];
                $payment->pay_email = $response['EMAIL'];
                // $payment->pay_date = $response['TIMESTAMP'];
                $payment->pay_token = $response['TOKEN'];
                $payment->pay_first_name = $response['FIRSTNAME'];
                $payment->pay_last_name = $response['LASTNAME'];
                $payment->pay_country = $response['COUNTRYCODE'];
                $payment->pay_currencycode = $response['CURRENCYCODE'];
                $payment->pay_mount = $response['AMT'];
                $payment->save(); 
                return redirect('after_pay');
            }else back();
        } 
    }

    public function cancel(Request $request)
    {
        // return 'User declined the payment!';   
    }
}
