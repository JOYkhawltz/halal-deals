<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Anouar\Paypalpayment\Facades\PaypalPayment as Paypalpayment;
use Carbon\Carbon;
use Exception;
use Mail;
use Illuminate\Http\Response;
// use PayPal\Api\Payment;
// use Paypal\Api\PaymentExecution;
// use PayPal\Api\ExecutePayment;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
// use App\Services\PaymentExecution;
// ************ Request ************
// use App\Http\Requests\PaymentRequest;
// ************ Models ************
use App\User;
use App\PaymentDetail;
use App\Setting;

class Payments {

    protected $clientSecret;
    protected $clientId;
    protected $stripe_secret;

    public function __construct() {
        // $paypal_client = Setting::where('slug', '=', 'PAYPAL_CLIENT_ID')->first();
        // $paypal_client_secret = Setting::where('slug', '=', 'PAYPAL_CLIENT_SECRET')->first();
        // $this->clientId = (isset($paypal_client->value) && $paypal_client->value != "") ? $paypal_client->value : "AT5CxLEhal5EW0YCQ8Aj6NjRg27V0qIyZAWYTX17Zg6KcccP-WlGWhHJw9W40A16WMvlOc3Z7MkRgtSB";
        // $this->clientSecret = (isset($paypal_client_secret->value) && $paypal_client_secret->value != "") ? $paypal_client_secret->value : "EN3bUMg1bDv_Ze-YhUAdc5ZHI3JFgw0krC-C6KmUndJdgdznN5R7Do9aamTASTtFxIDyeAJwnileFFrg";
        // // $stripeSecret = Settings::select('value')->where(['slug' => 'stripe_secret'])->first();
        // $this->stripe_secret = (isset($stripeSecret->value) && !empty($stripeSecret->value)) ? $stripeSecret->value : 'sk_test_KvZ9UQCw3u3CW01ReuQxl95k00Wr9xNOyK';
    }

    public function post_payment($request) {
        $data = [];
        // $plan = SubscriptionPlan::findorFail($request->input('plan'));
        // $plan_amount = number_format($plan->amount, 2);
        $card_number = str_replace(" ", "", $request->input('number'));
        $expiry = explode("/", $request->input('expiry'));
        $name = explode(" ", $request->input('name'));
        $data_arr = [
            // 'plan' => $request->input('plan'),
            // 'plan_title' => (isset($plan->name) && !empty($plan->name)) ? $plan->name : 'Test',
            'amount' => $request->input('total_amount'),
            'cardType' => ($request->input('card_type') != "") ? strtolower($request->input('card_type')) : "visa",
            'first_Name' => trim($name[0]),
            'last_Name' => (isset($name[1]) && $name[1] != "") ? trim($name[1]) : "Test",
            'cardNumber' => $card_number,
            'cardExpiryYear' => trim($expiry[1]),
            'cardExpiryMonth' => trim($expiry[0]),
            'cardCVC' => $request->input('cvc'),
        ];
        
        $response = $this->paywithCreditCard($data_arr);
        // print_r($response);
        // exit();
        if ($response['type'] == 1) {
            $data['status'] = 200;
            $data['details'] = $response['msg'];
        } else {
            $data['status'] = 400;
            $data['msg'] = $response['msg'];
        }
        return $data;
    }

    public function post_express_payment($request) {
        $data = [];
        // $plan = SubscriptionPlan::findorFail($request->input('plan'));
        // $plan_amount = number_format($plan->amount, 2);
        $data_arr = [
            // 'plan' => $request->input('plan'),
            // 'plan_title' => (isset($plan->name) && !empty($plan->name)) ? $plan->name : 'Test',
            'amount' => $request->input('total_amount')
        ];

        
        if($request->has('name')){
           // print_r($request->input());
           Session::put('name',$request->input('name')); 
        }
        if($request->has('phone')){
           // print_r($request->input());
           Session::put('phone',$request->input('phone')); 
        }
        if($request->has('address')){
           // print_r($request->input());
           Session::put('address',$request->input('address')); 
        }
        if($request->has('city')){
           // print_r($request->input());
           Session::put('city',$request->input('city')); 
        }
        if($request->has('country')){
           // print_r($request->input());
           Session::put('country',$request->input('country')); 
        }
        if($request->has('zipcode')){
           // print_r($request->input());
           Session::put('zipcode',$request->input('zipcode')); 
        }
        // exit();
        
        $response = $this->paywithPaypal($data_arr);
        
        $redirect_url = json_decode($response->content(), true);
        // print_r($response_data);
        // exit();
        $data['link'] = $redirect_url;
        $data['msg'] = 'Payment Agreement Done';
        $data['status'] = 200;
        // print_r($data['approval_url']);
        // // print_r($response->0) ;
        // exit();
        // if ($response['type'] == 1) {
        //     $data['status'] = 200;
        //     $data['details'] = $response['msg'];
        // } else {
        //     $data['status'] = 400;
        //     $data['msg'] = $response['msg'];
        // }
        return $data;
    }

    /*
     * Process payment using credit card
     */

    private function paywithCreditCard($info) {

        // ### CreditCard
        // print_r($info);
        // exit();
        $card = Paypalpayment::creditCard();
        $card->setType(strtolower(trim($info['cardType'])))
                ->setNumber(trim($info['cardNumber']))
                ->setExpireMonth(trim($info['cardExpiryMonth']))
                ->setExpireYear(trim($info['cardExpiryYear']))
                ->setCvv2(trim($info['cardCVC']))
                ->setFirstName(trim($info['first_Name']))
                ->setLastName(trim($info['last_Name']));

        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments([$fi]);

        $item1 = Paypalpayment::item();
        $item1->setName('coupon')
                ->setDescription('coupon')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setTax(0.00)
                ->setPrice($info['amount']);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1]);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("GBP")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($info['amount']);
//                ->setDetails($details);
        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());
        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'
        
        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions([$transaction]);
       
        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            try {
                $response = $payment->create(Paypalpayment::apiContext());
                $data['msg'] = $response;
                $data['type'] = 1;
                return $data;
                exit();
            } catch (Exception $ex) {
                $data['type'] = 2;
                $data['msg'] = $ex->getMessage();
                return $data;
                exit();
            }
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            $data['type'] = 2;
            $data['msg'] = $ex->getMessage();
            return $data;
            exit();
        } catch (Exception $ex) {

            $data['type'] = 2;
            $data['msg'] = $ex->getMessage();
            return $data;
            exit();
        }
    }

        /*
    * Process payment with express checkout
    */
    public function paywithPaypal($info)
    {
        // print_r(url("express-checkout-success"));
        // exit();
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        // $shippingAddress= Paypalpayment::shippingAddress();
        // $shippingAddress->setLine1("3909 Witmer Road")
        //     ->setLine2("Niagara Falls")
        //     ->setCity("Niagara Falls")
        //     ->setState("NY")
        //     ->setPostalCode("14305")
        //     ->setCountryCode("US")
        //     ->setPhone("716-298-1822")
        //     ->setRecipientName("Jhone");

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $item1 = Paypalpayment::item();
        $item1->setName('coupon')
                ->setDescription('coupon')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setTax(0.00)
                ->setPrice($info['amount']);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1]);


        // $details = Paypalpayment::details();
        // $details->setShipping("1.2")
        //         ->setTax("1.3")
        //         //total of items prices
        //         ->setSubtotal("17.5");

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("GBP")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($info['amount']);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(url("express-checkout-success"))
            ->setCancelUrl(url("express-checkout-fails"));

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create(Paypalpayment::apiContext());
        } catch (\PPConnectionException $ex) {
            return response()->json(["error" => $ex->getMessage()], 400);
        }

        $redirect_url = $payment->getApprovalLink();
       

         return response()->json($redirect_url, 200);
    }

    private function create_token($info) {
        $data = [];
        try {
            \Stripe\Stripe::setApiKey($this->stripe_secret);
            $token = \Stripe\Token::create([
                        'card' => [
                            'number' => $info['cardNumber'],
                            'exp_month' => $info['cardExpiryMonth'],
                            'exp_year' => $info['cardExpiryYear'],
                            'cvc' => $info['cardCVC']
                        ],
            ]);
            $data['id'] = $token['id'];
            $data['status'] = 200;
        } catch (\Stripe\Error\Card $e) {
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
        } catch (\Stripe\Exception\MissingParameterException $e) {
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
        }
        return $data;
    }

    private function make_payment($data_arr, $token) {
        $data = [];
        Stripe::setApiKey($this->stripe_secret);
        try {
            $payment = \Stripe\Charge::create([
//                        "amount" => 1 * 100,
                        "amount" => $data_arr['amount'] * 100,
                        "currency" => "GBP",
                        "source" => $token,
            ]);
            $data['msg'] = $payment;
            $data['status'] = 200;
        } catch (Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught
//            echo 'Status is:' . $e->getHttpStatus() . '\n';
//            echo 'Type is:' . $e->getError()->type . '\n';
//            echo 'Code is:' . $e->getError()->code . '\n';
//            // param is '' in this case
//            echo 'Param is:' . $e->getError()->param . '\n';
//            echo 'Message is:' . $e->getError()->message . '\n';
            $data['msg'] = $e->getError()->message;
            $data['status'] = 400;
        } catch (\Stripe\Exception\RateLimitException $e) {
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
            // Too many requests made to the API too quickly
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $data['msg'] = $e->getMessage();
            $data['status'] = 400;
        }
        return $data;
    }

    // public function express_checkout_success($request){
    //     if(isset($_GET['paymentId'])){
    //         $payment = Paypalpayment::get($_GET['paymentId'], $apiContext);
    //         print_r($payment);
    //     // exit();
    //     }
    //     print_r($_GET['paymentId']));
    //     exit();
    // }

    // public function express_checkout_fails(){
    //     print_r(3);
    //     exit();
    // }

    public function get_payment_details($payment_id)
    {
        // $payment = Paypalpayment::get($payment_id,$this-);
        // $data['payment_details'] = $payment_details = Paypalpayment::getById($payment_id, Paypalpayment::apiContext());
        $payment_details = Payment::get($payment_id, Paypalpayment::apiContext());
        // print_r($payment_details);
        // exit();
        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);
        $result = $payment_details->execute($execution,Paypalpayment::apiContext());
        if($result->getState() == 'approved' ){
            $resp['details'] = $payment_details;
        }else{
           // Session::put('error','Payment Failed');
           // return redirect()->route('/');
           return redirect()->route('/')->with('error','Payment Failed');    
        }
        return $resp;
    }

}
