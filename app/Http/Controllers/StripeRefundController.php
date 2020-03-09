<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StripeService;
use App\Services\StripeInvoiceService;

use App\Models\BusinessUnit;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class StripeRefundController extends Controller
{

    public function __construct() 
    {

        // $this->middleware(['auth', 'verified'])->only([ 'create', 'store' ]);
   
    }
    
    /**
     * Display a listing of the refunds.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeInvoiceService = new StripeInvoiceService();
      $result = $stripeInvoiceService->listRefunds();

      if ($result['message'] == 'Success'){

        $refund =  $result['refunds'];

        Log::debug($refund);

        for ( $i = 0; $i < count($refund->data); $i++) {

          // determine length of stripe amount field so we can add a deciaml point and display it correctly as currency
          $amountLen = strlen($refund->data[$i]['amount']);  
          $refundAmount = substr_replace( $refund->data[$i]['amount'], '.', $amountLen - 2, 0 ); 

          $refundArray[$i]['id'] = $refund->data[$i]['id'];
          $refundArray[$i]['amount'] = $refundAmount;
          $refundArray[$i]['charge'] = $refund->data[$i]['charge'];
          $refundArray[$i]['reason'] = $refund->data[$i]['reason'];
         
        }
  
        $refunds = json_decode(json_encode($refundArray), FALSE);
  
        return view('stripe.refund.index', ['refunds' => $refunds ]);

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

      return view('stripe.refund.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

      Log::debug("STORE REFUND");

      $businessUnit = BusinessUnit::find($businessUnit->id);

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeInvoiceService = new StripeInvoiceService();
      $result = $stripeInvoiceService->createRefund($businessUnit, $request->charge_id);

      if ($result['message'] == 'Success'){

       session()->flash('success', 'Refund created successfully.');
       
       return redirect( route ('refunds.index') );

      } else {

        Log::debug($result['message']);

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

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
        //
    }

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
