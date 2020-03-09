<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StripeService;
use App\Services\StripeSubscriptionService;
use App\Http\Resources\BusinessUnit as BusinessUnitResource;
use App\Http\Resources\StripeSubscription as StripeSubscriptionResource;
use App\Http\Resources\StripeListSubscriptions as StripeListSubscriptionsResource;
use App\Http\Resources\StripeScheduledSubscription as StripeScheduledSubscriptionResource;
use App\Http\Resources\StripePlan as StripePlanResource;
use App\Http\Resources\StripeListPlans as StripeListPlansResource;
use App\Http\Resources\StripeDeletedPlan as StripeDeletedPlanResource;
use App\Http\Resources\StripeProduct as StripeProductResource;
use App\Http\Resources\StripeListProducts as StripeListProductsResource;
use App\Http\Resources\StripeDeletedProduct as StripeDeletedProductResource;
use App\Http\Resources\StripePaymentMethod as StripePaymentMethodResource;
use App\Http\Resources\StripeSource as StripeSourceResource;
use App\Http\Resources\StripeTaxRate as StripeTaxRateResource;
use App\Http\Resources\StripeListTaxRates as StripeListTaxRatesResource;
use App\Models\BusinessUnit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class StripeSubscriptionController extends Controller
{

    /**
     * Display a listing of subscriptions.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexSubscriptions()
    {

       Log::debug("INDEX SUBSCRIPTIONS");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->listSubscriptions();

       if ($result['message'] == 'Success'){

        return new StripeListSubscriptionsResource($result['subscriptions']);

        } else {

          // Log::debug($result['message']);

        }

    }   // end of indexSubscriptions

    /**
     * Display a listing of the plans.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexPlans()
    {

      //  Log::debug("INDEX PLAN");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->listPlans();

       if ($result['message'] == 'Success'){

         return new StripeListPlansResource($result['plans']);

       } else {

        //  Log::debug($result['message']);

       }

    }   // end of indexPlans

    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexProducts()
    {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->listProducts();

       if ($result['message'] == 'Success'){

         return new StripeListProductsResource($result['products']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of indexProducts

    /**
     * Display a listing of the tax rates.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexTaxRates()
    {

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->listTaxRates();

       if ($result['message'] == 'Success'){

          return new StripeListTaxRatesResource($result['taxRates']);

       } else {

          // Log::debug($result['message']);

       }

    }  // end of indexTaxRates

    /**
     * Store a newly created subscription in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeSubscription(Request $request)
    {
        // Log::debug("STORE SUBSCRIPTION");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeSubscriptionService = new StripeSubscriptionService();
        $result = $stripeSubscriptionService->createSubscription($request->product_name, $request->plan_id, $request->paymentmethod_id, $request->business_id );

        if ($result['message'] == 'Success'){

         return new StripeSubscriptionResource($result['subscription']);

         } else {

            // Log::debug($result['message']);

         }

    }  // end of storeSubscription

    /**
     * Store a newly created scheduled subscription in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeScheduledSubscription(Request $request)
    {
        // Log::debug("STORE SCHEDULED SUBSCRIPTION");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeSubscriptionService = new StripeSubscriptionService();
        $result = $stripeSubscriptionService->createScheduledSubscription($request->customer_id, $request->start_date, $request->plan_name, $request->tax_rate);

        if ($result['message'] == 'Success'){

         return new StripeScheduledSubscriptionResource($result['scheduledSubscription']);

         } else {

            // Log::debug($result['message']);

         }

    }  // end of storeScheduledSubscription

    /**
     * Store a newly created product in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeProduct(Request $request)
    {
        // Log::debug("STORE PRODUCT");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeSubscriptionService = new StripeSubscriptionService();
        $result = $stripeSubscriptionService->createProduct($request->name, $request->type);

        if ($result['message'] == 'Success'){

         return new StripeProductResource($result['product']);

         } else {

            // Log::debug($result['message']);

         }

    }  // end of storeProduct

    /**
     * Store a newly created plan in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storePlan(Request $request)
    {
        // Log::debug("STORE PLAN");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeSubscriptionService = new StripeSubscriptionService();
        $result = $stripeSubscriptionService->createPlan($request->amount, $request->currency, $request->interval, $request->product_name);

        if ($result['message'] == 'Success'){

         return new StripePlanResource($result['plan']);

         } else {

            // Log::debug($result['message']);

         }

    }  // end of storePlan

    /**
     * Store a newly created tax rate in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeTaxRate(Request $request)
    {
        // Log::debug("STORE TAX RATE");

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeSubscriptionService = new StripeSubscriptionService();
        $result = $stripeSubscriptionService->createTaxRate($request->tax_rate);

        if ($result['message'] == 'Success'){

         return new StripeTaxRateResource($result['taxRate']);

         } else {

            // Log::debug($result['message']);

         }

    }  // end of storeTaxRate

    /**
     * Display the specified subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showSubscription($id)
    {
      //  Log::debug("SHOW SUBSCRIPTION");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->findSubscription($id);

       if ($result['message'] == 'Success'){

         return new StripeSubscriptionResource($result['subscription']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of showSubscription

    /**
     * Display the specified scheduled subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showScheduledSubscription($id)
    {
      //  Log::debug("SHOW SCHEDULED SUBSCRIPTION");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->findScheduledSubscription($id);

       if ($result['message'] == 'Success'){

         return new StripeScheduledSubscriptionResource($result['scheduledSubscription']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of showSubscription

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showProduct($id)
    {
      //  Log::debug("SHOW PRODUCT");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->findProduct($id);

       if ($result['message'] == 'Success'){

         return new StripeProductResource($result['product']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of showProduct

    /**
     * Display the specified plan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showPlan($id)
    {
      //  Log::debug("SHOW PLAN IN CONTROLLER");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->findPlan($id);

       if ($result['message'] == 'Success'){

         return new StripePlanResource($result['plan']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of showPlan

    /**
     * Display the specified tax rate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showTaxRate($id)
    {

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->findTaxRate($id);

       if ($result['message'] == 'Success'){

         return new StripeTaxRateResource($result['taxRate']);

       } else {

        //  Log::debug($result['message']);
       }

    }  // end of showTaxRate

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateAssignnedPlan(Request $request, $id)
    {
      // Log::debug("CHANGE ASSIGNED PLAN");

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->changeAssignedPlan($id);

      if ($result['message'] == 'Success'){

         return new StripePlanResource($result['plan']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of updateAssignnedPlan

    /**
     * Cancel the specified subscription in Stripe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroySubscription(Request $request)
    {
      //  Log::debug("CANCEL SUBSCRIPTION");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->cancelSubscription($request->product_name, $request->business_id);

       if ($result['message'] == 'Success'){

         return new StripeSubscriptionResource($result['subscription']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of destroySubscription

    /**
     * Cancel the specified scheduled subscription in Stripe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyScheduledSubscription($id)
    {
      //  Log::debug("CANCEL SCHEDULED SUBSCRIPTION");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->cancelScheduledSubscription($id);

       if ($result['message'] == 'Success'){

         return new StripeScheduledSubscriptionResource($result['scheduledSubscription']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of destroyScheduledSubscription

    /**
     * Remove the specified product from Stripe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyProduct($id)
    {
      //  Log::debug("DESTROY PRODUCT");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->deleteProduct($id);

       if ($result['message'] == 'Success'){

         return new StripeDeletedProductResource($result['product']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of destroyProduct

    /**
     * Remove the specified plan from Stripe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyPlan($id)
    {
      //  Log::debug("DESTROY PLAN");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->deletePlan($id);

       if ($result['message'] == 'Success'){

         return new StripeDeletedPlanResource($result['plan']);

       } else {

        //  Log::debug($result['message']);

       }

    }  // end of destroyPlan

}  // end of class StripeSubscriptionController