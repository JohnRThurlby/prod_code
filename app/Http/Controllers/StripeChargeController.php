<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StripeService;
use App\Services\StripeInvoiceService;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class StripeChargeController extends Controller
{

    public function __construct() 
    {

        // $this->middleware(['auth', 'verified'])->only([ 'create', 'store' ]);
   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeInvoiceService = new StripeInvoiceService();
      $result = $stripeInvoiceService->listCharges();

      if ($result['message'] == 'Success'){

        $charge =  $result['charges'];

        for ( $i = 0; $i < count($charge->data); $i++) {

          // determine length of stripe amount field so we can add a deciaml point and display it correctly as currency
          $amountLen = strlen($charge->data[$i]['amount']);  
          $chargeAmount = substr_replace( $charge->data[$i]['amount'], '.', $amountLen - 2, 0 ); 

          $chargeArray[$i]['id'] = $charge->data[$i]['id'];
          $chargeArray[$i]['amount'] = $chargeAmount;
          $chargeArray[$i]['name'] = $charge->data[$i]['billing_details']['name'];
          $chargeArray[$i]['customer'] = $charge->data[$i]['customer'];
          $chargeArray[$i]['description'] = $charge->data[$i]['description'];
          $chargeArray[$i]['receipt_url'] = $charge->data[$i]['receipt_url'];
         
        }
  
        $charges = json_decode(json_encode($chargeArray), FALSE);
  
        return view('stripe.charge.index', ['charges' => $charges ]);

      } else {

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    } // end of index


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeInvoiceService = new StripeInvoiceService();
      $result = $stripeInvoiceService->findCharge($id);

      if ($result['message'] == 'Success'){

        $charge =  $result['charge'];

        // determine length of stripe amount field so we can add a deciaml point and display it correctly as currency
        $amountLen = strlen($charge->amount);  
        $chargeAmount = substr_replace( $charge->amount, '.', $amountLen - 2, 0 ); 

        $chargeArray[0]['id'] = $charge->id;
        $chargeArray[0]['name'] = $charge->billing_details->name;
        $chargeArray[0]['customer'] = $charge->customer;
        $chargeArray[0]['amount'] = $chargeAmount;
        $chargeArray[0]['description'] = $charge->description;
        $chargeArray[0]['receipt_url'] = $charge->receipt_url;
           
        $charge = json_decode(json_encode($chargeArray), FALSE);
  
        return view('stripe.charge.create', ['charge' => $charge ]);

      } else {

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    }  //end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        //
        
    }
}
