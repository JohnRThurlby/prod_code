<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStripeUserRequest;

use App\Http\Resources\BusinessUnit as BusinessUnitResource;

use App\Models\BusinessUnit;

use Carbon\Carbon;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class StripeSubscriptionService
{

    /**
     * Find a Stripe Product.
     *
     * @param
     */

    public function findProduct(string $product_id)
    {

      $message = 'Success';
      $product = '';

      // Retrieve a product

      try {

        $product  = \Stripe\Product::retrieve
        (
          $product_id

        );  // end retrieve

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      // Log::debug("FIND PRODUCT IN SUB SERVICE");

      return array(
        'message' => $message,
        'product' => $product);

    }  // end function findProduct

    /**
     * Create a Stripe Product.
     *
     * @param
     */

    public function createProduct(string $name)
    {
        $message = 'Success';
        $product = '';

        // Create a product

        try {

          $product  = \Stripe\Product::create([
            'name' => $name,
            'type' => 'service',
          ]);

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'product' => $product);

    }  // end function createProduct

    /**
     * Update a Stripe Product.
     *
     * @param
     */

    public function updateProduct(string $product_id, string $name)
    {

        $message = 'Success';
        $product = '';

        // Update a product

        try {

          $product  = \Stripe\Product::update(
            $product_id,
            ['name' => $name]
          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'product' => $product);

    }  // end function updateProduct

    /**
     * Delete a Stripe Product.
     *
     * @param
     */

    public function deleteProduct(string $product_id)
    {

        $message = 'Success';
        $product = '';

        // Delete a product

        try {

          $product = \Stripe\Product::retrieve(

            $product_id

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        try {

          $product->delete();

        } catch (\Stripe\Exception\InvalidRequestException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'product' => $product);

    }  // end function deleteProduct

     /**
     * List all Stripe Products.
     *
     * @param
     */

    public function listProducts()
    {

        $message = 'Success';
        $products = '';

        // List all product

        try {

          $products = \Stripe\Product::all(

            ['limit' => 5]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'products' => $products);

    }  // end function listProducts

    /**
    * Find a Stripe Plan.
    *
    * @param
    */

    public function findPlan(string $plan_id)
    {
        $message = 'Success';
        $plan = '';

        // Retrieve a plan

        try {

          $plan = \Stripe\Plan::retrieve(

            $plan_id

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'plan' => $plan);

    }  // end function findPlan

    /**
     * Create a Stripe Plan.
     *
     * @param
     */

    public function createPlan(string $amount, string $name, string $product, string $interval)
    {
      
        $message = 'Success';
        $plan = '';

        // Create a plan

        try {

          $plan = \Stripe\Plan::create(

            [
            'amount' => $amount,
            'currency' => 'USD',
            'interval' => $interval,
            'product' => $product,

          ]);

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'plan' => $plan);

    }  // end function createPlan

    /**
     * Update a Stripe Plan.
     *
     * @param
     */

    public function updatePlan(string $plan_id)
    {
        $message = 'Success';
        $plan = '';

        // Update a plan

        try {

          $plan = \Stripe\Plan::update(

            $plan_id,

            ['metadata' => ['order_id' => '6735']]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'plan' => $plan);

    }  // end function updatePlan


    /**
     * Delete a Stripe Plan.
     *
     * @param
     */

    public function deletePlan(string $plan_id)
    {
        $message = 'Success';
        $plan = '';

        // Delete a plan

        try {

          $plan = \Stripe\Plan::retrieve(

            $plan_id

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        try {

          $plan->delete();

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'plan' => $plan);

    }  // end function deletePlan

    /**
     * List all Stripe Plans.
     *
     * @param
     */

    public function listPlans()
    {
        $message = 'Success';
        $plans = '';

        // List all plans

        try {

          $plans = \Stripe\Plan::all(

            ['limit' => 5]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'plans' => $plans);

    }  // end function listPlans

    /**
    * Find a Stripe Coupon.
    *
    * @param
    */

    public function findCoupon(string $coupon_id)
    {
        $message = 'Success';
        $coupon = '';

        // Retrieve a Coupon

        try {

          $coupon = \Stripe\Coupon::retrieve(

            $coupon_id

          );  // end retrieve

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        // Log::debug("FIND coupon IN SUB SERVICE");

        return array(
          'message' => $message,
          'coupon' => $coupon);

    }  // end function findCoupon

    /**
     * Create a Stripe Coupon.
     *
     * @param
     */

    public function createCoupon(string $percent, string $duration, string $coupon_name, string $months)
    {

        $message = 'Success';
        $coupon = '';

        // Create a coupon

        try {

          if ( $duration != 'repeating' ) {
            $coupon = \Stripe\Coupon::create(
              [
              'percent_off' => $percent,
              'currency'    => 'USD',
              'duration'    => $duration,
              'name'        => $coupon_name,

            ]);

          } else {

            $coupon = \Stripe\Coupon::create(
              [
              'percent_off' => $percent,
              'currency'    => 'USD',
              'duration'    => $duration,
              'name'        => $coupon_name,
              'duration_in_months' => $months,
  
            ]);

          }

        } catch (Exception $e) {

          $message = $e->getError()->message;

        }  // end catch

        return array(
          'message' => $message,
          'coupon' => $coupon);

    }  // end function createCoupon

    /**
     * Delete a Stripe Coupon.
     *
     * @param
     */

    public function deleteCoupon(string $couponId)
    {

        $message = 'Success';
        $coupon = '';

        // Log::debug("IN DELETECOUPON");

        // Delete a coupon

        try {

          $coupon = \Stripe\Coupon::retrieve(

            $couponId

          );  // end retrieve

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        Log::debug($message);

        try {

           $coupon->delete();

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'coupon' => $coupon);

    }  // end function deleteCoupon

    /**
     * List all Stripe Coupons.
     *
     * @param
     */

    public function listCoupons()
    {

        $message = 'Success';
        $coupons = '';

        // List all coupons

        try {

          $coupons = \Stripe\Coupon::all(

            ['limit' => 5]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'coupons' => $coupons);

      }  // end function listCoupons

    /**
    * Find a Stripe Subscription.
    *
    * @param  string $subscription_id
    */

    public function findSubscription(string $subscription_id)
    {
        $message = 'Success';
        $subscription = '';

        // Retrieve a subscription

        try {

          $subscription = \Stripe\Subscription::retrieve(

            $subscription_id

          );


        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscription' => $subscription);

    }  // end function findSubscription

    /**
    * Create a Stripe Subscription.
    *
    * @param  Request $request consists of paymentMethod_id, product_name, and plan_id
    */

    //public function createSubscription(BusinessUnit $businessUnit, Request $request)
    public function createSubscription(string $product_name, string $plan_id, string $paymentmethod_id, string $business_id)
    {

      $message = 'Success';
      $subscription = '';

      try {

        $businessUnit = BusinessUnit::find($business_id);

        $anchor = Carbon::parse('first day of next month');

          $subscription = $businessUnit->newSubscription($product_name, $plan_id)
          ->anchorBillingCycleOn($anchor->startOfDay())
          ->create($paymentmethod_id);

          // Log::debug("CREATE SUBSCRIPTION");

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscription' => $subscription);

    }  // end function createSubscription

    /**
    * Update a Stripe Subscription.
    *
    * @param
    */

    public function updateSubscription(Request $request)
    {

        $message = 'Success';
        $subscription = '';

        // Update a subscription

        try {

          $subscription = \Stripe\Subscription::update(

            $request->subscription_id,
            ['metadata' => ['order_id' => '6735']]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscription' => $subscription);

    }  // end function updateSubscription

    /**
    * Cancel a Stripe Subscription.
    *
    * @param  Request $request consisting of product_name
    */

    public function cancelSubscription(string $product_name, string $business_id)
    {

        $message = 'Success';
        $subscription = '';

        // Cancel a subscription

        try {

          // Log::debug("CANCEL SUBSCRIPTION IN SUBSCRIPTION SERVICE");
          // Log::debug($product_name);
          // Log::debug($business_id);

          $businessUnit = BusinessUnit::find($business_id);

          $subscription = $businessUnit->subscription($product_name)->cancel();

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscription' => $subscription);

    }  // end function cancelSubscription

    /**
    * Resume a cacelled Stripe Subscription.
    *
    * @param  Request $request consisting of product_name
    */

    //public function cancelSubscription(string $subscription_id)
    public function resumeSubscription(BusinessUnit $businessUnit, Request $request )
    {

        $message = 'Success';
        $subscription = '';

        // Resume a subscription

        try {

          $subscription = $businessUnit->subscription($request->product_name)->resume();

          // Log::debug("RESUME SUBSCRIPTION");

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscription' => $subscription);

    }  // end function resumeSubscription

    /**
    * List all Stripe Subscriptions.
    *
    * @param
    */

    public function listSubscriptions()
    {
        $message = 'Success';
        $subscriptions = '';

        // List all subscriptions

        try {

          $subscriptions = \Stripe\Subscription::all(

            ['limit' => 3]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscriptions' => $subscriptions);

    }  // end function listSubscriptions

    /**
    * Sync a change to a tax percentage for a Stripe Customer. Found on w3resource.com
    *
    * @param  Request $request consisting of product_name and plan_id
    */

    public function syncTaxPercentage(BusinessUnit $businessUnit, Request $request)
    {

        $message = 'Success';
        $subscription = '';

        // Sync tax percentage

        try {

          $subscription = $businessUnit->subscription($request->product_name)->syncTaxPercentage();

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscription' => $subscription);

    }  // end function syncTaxPercentage

    /**
    * List credit cards associated to a Stripe Customer. Found on w3resource.com
    *
    * @param
    */

    public function listCreditCards(BusinessUnit $businessUnit)
    {
        $message = 'Success';
        $cards = '';

        // List credit cards

        try {

          $cards = $businessUnit->cards();

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'cards' => $cards);

    }  // end function listCreditCards

    /**
    * List a default credit card associated to a Stripe Customer. Found on w3resource.com
    *
    * @param
    */

    public function listDefaultCreditCard(BusinessUnit $businessUnit)
    {

        $message = 'Success';
        $card = '';

        // List default credit card

        try {

          $card = $businessUnit->defaultCard();

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'card' => $card);

    }  // end function listDefaultCreditCard

    /**
    * Change subscription plan associated to a Stripe Customer.
    *
    * @param  Request $request consisting of product_name and plan_id
    */

    public function changeAssignedPlan(BusinessUnit $businessUnit, Request $request)
    {

        $message = 'Success';
        $subscription = '';

        // Change associated plan

        try {

          $businessUnit = App\BusinessUnit::find($businessUnit->id);

          $subscription = $businessUnit->subscription($request->product_name)->swap($request->plan_id);

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'subscription' => $subscription);

    }  // end function changeAssignedPlan

    /**
    * Create a Stripe Scheduled Subscription.
    *
    * @param  Request $request consists of customer_id, start_date, plan_name, tax_rate
    */

    public function createScheduledSubscription(string $customer_id, string $start_date, string $plan_name, string $tax_rate)
    {

      $message = 'Success';
      $scheduledSubscription = '';

      // Create Scheduled Subscription
       
      try {

        $timestamp = strtotime($start_date);

        $scheduledSubscription = \Stripe\SubscriptionSchedule::create([
          'customer' => $customer_id,
          'start_date' => $timestamp,
          'phases' => [
            [
              'plans' => [
                [
                  'plan' => $plan_name,
                  'tax_rates[0]' => $tax_rate,
                ],
              ],
            ],
          ],
        ]);

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      return array(
        'message' => $message,
        'scheduledSubscription' => $scheduledSubscription);

    }  // end function createScheduledSubscription

    /**
    * Retrieve a Stripe Scheduled Subscription.
    *
    * @param  Request $request consists of subscription_id
    */

    public function findScheduledSubscription(string $subscription_id)
    {

      $message = 'Success';
      $scheduledSubscription = '';

      // Retrieve Scheduled Subscription
       
      try {

        $scheduledSubscription = \Stripe\SubscriptionSchedule::retrieve(
          $subscription_id
        );

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      return array(
        'message' => $message,
        'scheduledSubscription' => $scheduledSubscription);

    }  // end function findScheduledSubscription

    /**
    * Cancel a Stripe Scheduled Subscription.
    *
    * @param  Request $request consists of subscription_id
    */

    public function cancelScheduledSubscription(string $subscription_id)
    {

      $message = 'Success';
      $scheduledSubscription = '';

      // Cancel a Scheduled Subscription
       
      try {

        $scheduledSubscription = \Stripe\SubscriptionSchedule::retrieve(
          $subscription_id
        );

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      try {

        $scheduledSubscription->cancel();

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      return array(
        'message' => $message,
        'scheduledSubscription' => $scheduledSubscription);

    }  // end function cancelScheduledSubscription

    /**
    * Create a Stripe Tax Rate.
    *
    * @param  Request $request consists of tax_rate
    */

    public function createTaxRate(string $tax_rate)
    {

      $message = 'Success';
      $taxRate = '';

      // Create a tax rate
       
      try {

        $taxRate = \Stripe\TaxRate::create([
          'display_name' => 'FL State Tax',
          'jurisdiction' => 'US',
          'percentage' => $tax_rate,
          'inclusive' => false,
        ]);

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      return array(
        'message' => $message,
        'taxRate' => $taxRate);

    }  // end function createTaxRate

    /**
    * List Stripe Tax Rates.
    *
    * @param  None
    */

    public function listTaxRates()
    {

      $message = 'Success';
      $taxRates = '';

      // List tax rates
       
      try {

        $taxRates = \Stripe\TaxRate::all(
          ['limit' => 3,
           'active' => true,
        ]);

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      return array(
        'message' => $message,
        'taxRates' => $taxRates);

    }  // end function ListTaxRates

    /**
    * Retrieve a Stripe Tax Rate.
    *
    * @param  string $tax_rateId
    */

    public function findTaxRate(string $tax_rateId)
    {

      $message = 'Success';
      $taxRates = '';

      // Retrieve tax rate
       
      try {

        $taxRate = \Stripe\TaxRate::retrieve(
          $tax_rateId
        );

      } catch (\Stripe\Exception\ApiErrorException $e) {

        $message = $e->getError()->message;

      } catch (Exception $e) {

        $message = $e->getError()->message;

      } // end catch

      return array(
        'message' => $message,
        'taxRate' => $taxRate);

    }  // end function findTaxRate

}