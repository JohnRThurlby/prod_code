<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStripeUserRequest;

use App\Http\Resources\BusinessUnit as BusinessUnitResource;

use App\Models\BusinessUnit;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class StripeService
{

  /**
     * Set Stripe secret key.
     *
     * @param  none
     */

    public function setStripeKey() 
    {
      
      // Set Stripe key
      \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
      
    } // end function setStripeKey

    /**
     * Find an Stripe customer.
     *
     * @param  
     */

    public function findCustomer(string $stripe_id) 
    {
      
      $custexists = \Stripe\Customer::retrieve($stripe_id);
      Log::debug($custexists);

      if (!$custexists){

        Log::debug("FUNCTION CUSTOMER NOT EXIST");

         return $customerExists = false;

      } else {

        Log::debug("FUNCTION CUSTOMER EXISTS");

        if ($custexists->deleted){

          Log::debug("FUNCTION CUSTOMER DELETED");
          return $customerExists = false;

        } else {

          Log::debug("FUNCTION CUSTOMER NOT DELETED");
          return $customerExists = true;

        }

      }

    } // end function findCustomer

    /**
     * Create an Stripe customer.
     *
     * @param  
     */

    public function createCustomer($businessUnit)
    {

      $businessUnit->createAsStripeCustomer();
       
    } // end function createCustomer

    /**
     * Update the Stripe customer.
     *
     * @param $businessUnit 
     */

    public function updateCustomer($businessUnit)
    {
        
          $data = new BusinessUnitResource($businessUnit->load(['users' => function ($subQuery) {
            return $subQuery->where('role_id', 2)->first();
          }]));  // end of $data
    
          $customer = \Stripe\Customer::update(
            $businessUnit->stripe_id,
           [ 'name' => $data->name, 
             'phone' => $data->phone_number,
             'address' => [
                'line1' =>  $data->address->address1,
                'city' => $data->address->city,
                'state' => $data->address->state,
                'postal_code' => $data->address->zipcode,
                'country' => 'US',
             ]]
          );  // end of Stripe Customer update

    } // end function updateCustomer

     /**
     * Delete the Stripe customer.
     *
     * @param $businessUnit 
     */

    public function deleteCustomer($businessUnit)
    {
        
      $data = new BusinessUnitResource($businessUnit->load(['users' => function ($subQuery) {
        
        return $subQuery->where('role_id', 2)->first();
     
      }]));  // end of $data

      $customer = \Stripe\Customer::retrieve(

         $businessUnit->stripe_id

      ); // end of Stripe Customer retrieve

       $customer->delete();
          
    } // end function deleteCustomer

     /**
     * Listthe Stripe customer.
     *
     * @param 
     */

    public function listCustomers()
    {

          $customers = \Stripe\Customer::all(
            
            ['limit' => 5]
          
          );
          
    } // end function listCustomers

    /**
     * Find a Stripe Payment method.
     *
     * @param $businessUnit
     */

    public function findPaymentMethod($businessUnit)
    {

      

      if ($businessUnit->hasPaymentMethod()) {

        Log::debug($businessUnit->id);

        Log::debug("INSIDE HAS  STRIPE SERVICE PAYMENT METHOD");

        $paymentMethods = $businessUnit->paymentMethods();

        Log::debug($paymentMethods->id);
      
        return $paymentMethods;

      } else{

        Log::debug("INSIDE HAS  NO PAYMENT METHOD");

      }
       
    } // end function findPaymentMethod

    /**
     * Create a Stripe Payment method.
     *
     * @param  $request, $businessUnit
     */

    public function createPaymentMethod($request, $businessUnit)
    {

      $data = new BusinessUnitResource($businessUnit->load(['users' => function ($subQuery) {
        return $subQuery->where('role_id', 2)->first();
      }]));  // end of $data 

      $paymentMethods = \Stripe\PaymentMethod::create([
          
        'type' => 'card',
        'billing_details' =>
        ['address' =>
          ['line1' =>  $data->address->address1,
            'city' => $data->address->city,
            'state' => $data->address->state,
            'postal_code' => $data->address->zipcode,
            'country' => 'US'],
            'email' => $data->email,
            'phone' => $data->phone_number,
            'name' => $data->name],
        'card' => [
            'number' => '4242424242424242',
            'exp_month' => $request->card['exp_month'],
            'exp_year' => $request->card['exp_year'],
            'cvc' => '314',
        ],

      ]);  // end of Stripe Payment method create

      Log::debug("PAYMENT METHOD");
      $payment_id = $paymentMethods->id;
      return $payment_id;
       
    } // end function createPaymentMethod

    /**
     * Update a Stripe Payment method.
     *
     * @param 
     */

    public function updatePaymentMethod()
    {

      $payment_method = \Stripe\PaymentMethod::update(

        'pm_1Fntdw2eZvKYlo2CET6rUiYZ',
        ['metadata' => ['order_id' => '6735']]

      );
       
    }  // end function updatePaymentMethod

    /**
     * Delete a Stripe Payment method.
     *
     * @param 
     */

    public function deletePaymentMethod()
    {

      $payment_method = \Stripe\PaymentMethod::retrieve(

        'pm_123456789'

      );

      $payment_method->detach();
       
    }  // end function deletePaymentMethod

    /**
     * List a Stripe Customer Payment Methods.
     *
     * @param 
     */

    public function listCustomerPaymentMethods(string $stripe_id)
    {

      $payment_methods =  \Stripe\PaymentMethod::all(
        
        ['customer' => $stripe_id,
        'type' => 'card',

      ]);
       
    }  // end function listcustomerPaymentMethods

    /**
     * Create a Stripe Source method.
     *
     * @param $businessUnit->stripe_id, $request->id, array $request
     */

    public function createSource(string $stripe_id, string $request_id)
    {
       
        $source = \Stripe\Customer::createSource(

            $stripe_id,
            ['source' => $request_id] 
    
        );  // end function Customer createSource

        $source_id = $source->id;
        return $source_id;

    }  // end function createSource


    /**
     * Update a Stripe Source method.
     *    
     *   @param $businessUnit->stripe_id, $source->id, $request, $businessUnit
     */

    public function updateSource(string $stripe_id, string $source_id, $request, $businessUnit)
    {

      $data = new BusinessUnitResource($businessUnit->load(['users' => function ($subQuery) {
        return $subQuery->where('role_id', 2)->first();
      }]));  // end of $data 

      $updateSource = \Stripe\Customer::updateSource(

        $stripe_id,
        $source_id,
        ['name' => $data->name,
         'exp_month' => $request->card['exp_month'],
         'exp_year' => $request->card['exp_year'],
         'address_line1' =>  $data->address->address1,
         'address_city' => $data->address->city,
         'address_state' => $data->address->state,
         'address_zip' => $data->address->zipcode,
         'address_country' => 'US',
        ]
    
      );  // end function Customer updateSource

      Log::debug("UPDATED SOURCE");

    }  // end function Customer updateSource


    /**
     * Attach a Stripe Payment method to a Stripe Customer.
     *
     * @param  $paymentMethod->id, $businessUnit->stripe_id,
     */

    public function attachPayment(string $paymethod_id, string $stripe_id)
    {
       
        // Retrieve a payment method

        $payment_method = \Stripe\PaymentMethod::retrieve(
            
            $paymethod_id
        
        ); // end of Stripe Payment method retrieve

        // Attach the payment method

        $payment_method->attach([
        
          'customer' => $stripe_id,
        
        ]); // end of Stripe Payment method attach

        Log::debug("ATTACHED PAYMENT");

    }  // end function attachPayment

}