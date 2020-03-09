<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StripeService;
use App\Services\StripeSubscriptionService;

use App\Http\Resources\StripePlan as StripePlanResource;
use App\Http\Resources\StripeListPlans as StripeListPlansResource;
use App\Http\Resources\StripeDeletedPlan as StripeDeletedPlanResource;

use App\Http\Requests\StoreStripePlanRequest;
use App\Http\Requests\UpdateStripePlanRequest;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class StripePlanController extends Controller
{

    public function __construct() 
    {

        // $this->middleware(['auth', 'verified'])->only([ 'create', 'store' ]);
   
    }

    /**
     * Display a listing of the plans.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {

       Log::debug("INDEX PLAN");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->listPlans();

       if ($result['message'] == 'Success'){

        $plan =  $result['plans'];

        for ( $i = 0; $i < count($plan->data); $i++) {
     
          // determine length of stripe amount field so we can add a deciaml point and display it correctly as currency
          $amountLen = strlen($plan->data[$i]['amount_decimal']);  
          $amount = substr_replace( $plan->data[$i]['amount_decimal'], '.', $amountLen - 2, 0 ); 

          $planArray[$i]['id'] = $plan->data[$i]['id'];
          $planArray[$i]['product'] = $plan->data[$i]['product'];
          $planArray[$i]['interval'] = $plan->data[$i]['interval'];
          $planArray[$i]['amount_decimal'] = $amount;
          $planArray[$i]['nickname'] = $plan->data[$i]['nickname'];
         
        }

        Log::debug($planArray);

        $plans = json_decode(json_encode($planArray), FALSE);
  
        return view('stripe.plan.index', ['plans' => $plans ]);

      } else {

        Log::debug($result['message']);

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    }   // end of indexPlans

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('stripe.plan.create');

    }

    /**
     * Store a newly created plan in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreStripePlanRequest $request)
    {
        Log::debug("STORE PLAN");

        $amount = $request->amount . '00';

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeSubscriptionService = new StripeSubscriptionService();
        $result = $stripeSubscriptionService->createPlan($amount, $request->name, $request->product, $request->interval);

        if ($result['message'] == 'Success'){

         session()->flash('success', 'Plan created successfully.');
         
         return redirect( route ('plans.index') );

        } else {

          Log::debug($result['message']);

          session()->flash('error', $result['message']);
  
          return redirect()->back();

        }

    }  // end of storePlan

    /**
     * Display the specified plan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
       Log::debug("SHOW PLAN IN CONTROLLER");

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->findPlan($id);

       if ($result['message'] == 'Success'){

         return new StripePlanResource($result['plan']);

       } else {

        Log::debug($result['message']);

        session()->flash('error', $result['message']);

        return redirect()->back();

       }

    }  // end of showPlan

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {

      Log::debug("EDIT PLAN IN CONTROLLER");

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->findPlan($id);

      if ($result['message'] == 'Success'){

        $plan =  $result['plan'];

        $amountLen = strlen($plan->amount_decimal);  
        $amount = substr_replace( $plan->amount_decimal, '.', $amountLen - 2, 0 ); 

        $planArray[0]['id'] = $plan->id;
        $planArray[0]['product'] = $plan->product;
        $planArray[0]['interval'] = $plan->interval;
        $planArray[0]['amount'] = $amount;
        $planArray[0]['nickname'] = $plan->nickname;
  
        $plan = json_decode(json_encode($planArray), FALSE);
        
        return view('stripe.plan.create', ['plan' => $plan ]);

      } else {

       Log::debug($result['message']);

       session()->flash('error', $result['message']);

       return redirect()->back();

      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStripePlanRequest $request)
    {

      Log::debug("UPDATE PLAN");

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->createPlan($request->amount, $request->name, $request->product, $request->interval);

      if ($result['message'] == 'Success'){

       session()->flash('success', 'Plan updated successfully.');
       
       return redirect( route ('plans.index') );

      } else {

        Log::debug($result['message']);

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    }

    /**
     * Remove the specified plan from Stripe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
      Log::debug("DESTROY PLAN");

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->deletePlan($id);

      if ($result['message'] == 'Success'){

        //return new StripeDeletedPlanResource($result['plan']);

        session()->flash('success', 'Plan deleted successfully.');
         
        return redirect( route ('plans.index') );

      } else {

        Log::debug($result['message']);

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    }  // end of destroyPlan
}
