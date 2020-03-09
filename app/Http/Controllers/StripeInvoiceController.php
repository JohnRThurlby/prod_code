<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StripeService;
use App\Services\StripeInvoiceService;

use App\Http\Resources\StripeFraudWarning as StripeFraudWarningResource;
use App\Http\Resources\StripeListFraudWarnings as StripeListFraudWarningsResource;

use App\Http\Resources\StripeListRefunds as StripeListRefundsResource;
use App\Http\Resources\StripeRefund as StripeRefundResource;

use App\Http\Resources\StripeCharge as StripeChargeResource;
use App\Http\Resources\StripeListCharges as StripeListChargesResource;

use App\Http\Resources\StripeListInvoices as StripeListInvoicesResource;

use App\Models\BusinessUnit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class StripeInvoiceController extends Controller
{
    /**
     * Display a listing of Stripe Invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexInvoices()
    {
       Log::debug("INDEX INVOICES");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeInvoiceService = new StripeInvoiceService();
       $result = $stripeInvoiceService->listInvoices();

       if ($result['message'] == 'Success'){

         return new StripeListInvoicesResource($result['invoices']);

        } else {

          Log::debug($result['message']);

        }

    }  // end of indexInvoices

    /**
     * Display a listing of Stripe Charges.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCharges()
    {
       Log::debug("INDEX CHARGESS");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeInvoiceService = new StripeInvoiceService();
       $result = $stripeInvoiceService->listCharges();

       if ($result['message'] == 'Success'){

         return new StripeListChargesResource($result['charges']);

        } else {

          Log::debug($result['message']);

        }

    }  // end of indexCharges

    /**
     * Display a listing of the Stripe Fraud Warnings.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFraudWarnings()
    {
       Log::debug("INDEX FRAUD WARNINGS");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeInvoiceService = new StripeInvoiceService();
       $result = $stripeInvoiceService->listFraudWarnings();

       if ($result['message'] == 'Success'){

         return new StripeListFraudWarningsResource($result['frauds']);

        } else {

          Log::debug($result['message']);

        }

    }  // end of indexFraudWarnings

    /**
     * Display a listing of the Stripe Refunds.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRefunds()
    {
       Log::debug("INDEX REFUNDS");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeInvoiceService = new StripeInvoiceService();
       $result = $stripeInvoiceService->listRefunds();

       if ($result['message'] == 'Success'){

         return new StripeListRefundsResource($result['refunds']);

        } else {

          Log::debug($result['message']);

        }

    }  // end of indexRefunds

    /**
     * Display the specified Stripe Invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showInvoice($invoice_id)
    {
        Log::debug("SHOW AN INVOICE");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeInvoiceService = new StripeInvoiceService();
        $result = $stripeInvoiceService->findInvoice($invoice_id);

        if ($result['message'] == 'Success'){

          return new StripeInvoiceResource($result['invoice']);

        } else {

           Log::debug($result['message']);

        }

    }  // end of showInvoice

    /**
     * Display the specified Stripe Refund.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRefund($refund_id)
    {
        Log::debug("SHOW A REFUND");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeInvoiceService = new StripeInvoiceService();
        $result = $stripeInvoiceService->findRefund($refund_id);

        if ($result['message'] == 'Success'){

          return new StripeRefundResource($result['refund']);

        } else {

           Log::debug($result['message']);

        }

    }  // end of showRefund

    /**
     * Display the specified Stripe Charge.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCharge($charge_id)
    {
        Log::debug("SHOW A CHARGE");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeInvoiceService = new StripeInvoiceService();
        $result = $stripeInvoiceService->findCharge($charge_id);

        if ($result['message'] == 'Success'){

          return new StripeChargeResource($result['charge']);

        } else {

           Log::debug($result['message']);

        }

    }  // end of showCharge

    /**
     * Display the specified Stripe Fraud Warning.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFraudWarning($fraud_id)
    {
        Log::debug("SHOW A FRAUD");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeInvoiceService = new StripeInvoiceService();
        $result = $stripeInvoiceService->findFraudWarning($fraud_id);

        if ($result['message'] == 'Success'){

          return new StripeFraudWarningResource($result['fraud']);

        } else {

           Log::debug($result['message']);

        }

    }  // end of showFraudWarning

    /**
     * Store a newly created refund in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRefund(Request $request)
    {
        Log::debug("STORE REFUND");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeInvoiceService = new StripeInvoiceService();
        $result = $stripeInvoiceService->createRefund($request->charge_id);

        if ($result['message'] == 'Success'){

          return new StripeRefundResource($result['refund']);

        } else {

           Log::debug($result['message']);

        }

    }  // end of storeRefund

    /**
     * Store a charge in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeCharge(BusinessUnit $businessUnit, Request $request)
    {
        Log::debug("STORE CHARGE");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeInvoiceService = new StripeInvoiceService();
        $result = $stripeInvoiceService->createCharge($request->invoice_description, $request->amount);

        if ($result['message'] == 'Success'){

          return new StripeChargeResource($result['charge']);

        } else {

           Log::debug($result['message']);

        }

    }  // end of storeChasrge

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //if ($result['message'] == 'Success'){

      //return new StripeChargeResource($result['charge']);

      //  } else {

      //Log::debug($result['message']);

      //  }

    }  // end of storeChasrge


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
