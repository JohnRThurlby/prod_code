<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStripeUserRequest;
use App\Services\StripeService;
use App\Services\StripeSubscriptionService;

use App\Http\Resources\BusinessUnit as BusinessUnitResource;

use App\Models\BusinessUnit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class StripeController extends Controller
{
    
    public function createStripeUser(BusinessUnit $businessUnit, Request $request)
    {

      // Set Stripe key
     
      $stripeService = new StripeService();
      $stripeService->setStripeKey();
      

      $businessUnit = BusinessUnit::find($businessUnit->id);

      if ($businessUnit->stripe_id == NULL){ 

        // $stripeService = new StripeService();
        $stripeService->createCustomer($businessUnit);

      }

      // $stripeService = new StripeService();
      $stripeService->UpdateCustomer($businessUnit);

      // Create a Stripe Payment Method

      // $stripeService = new StripeService();
      $payment_id = $stripeService->createPaymentMethod($request, $businessUnit);
      // Log::debug($payment_id);
      // Log::debug($businessUnit->id);

      // $stripeService = new StripeService();
      $stripeService->attachPayment($payment_id, $businessUnit->stripe_id);

      $stripeSubscriptionService = new StripeSubscriptionService();

      $product_name = "Monthly Inspection Plan";
      
      $plan_id = "plan_GXZPxdxCFBaYsM";

      $result = $stripeSubscriptionService->createSubscription($product_name, $plan_id, $payment_id, $businessUnit->id );

      if ($result['message'] == 'Success'){

        //return new StripeSubscriptionResource($result['subscription']);

        $subscription = $result['subscription'];

      } else {

        // Log::debug($result['message']);

      }

      // Retrieve and attach a Stipe Payment Method
    } // end function createStripeUser

}  // end class StripeController
