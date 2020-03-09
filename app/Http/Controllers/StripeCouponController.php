<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StripeService;
use App\Services\StripeSubscriptionService;

use App\Http\Resources\StripeCoupon as StripeCouponResource;
use App\Http\Resources\StripeListCoupons as StripeListCouponsResource;
use App\Http\Resources\StripeDeletedCoupon as StripeDeletedCouponResource;

use App\Http\Requests\StoreStripeCouponRequest;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class StripeCouponController extends Controller
{

   public function __construct() 
   {

        // $this->middleware(['auth', 'verified'])->only([ 'create', 'store' ]);
   
   }

   /**
     * Show all the coupons in Stripe.
     *
     * @return \Illuminate\Http\Response
     */

   public function index()
   {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->listCoupons();

      if ($result['message'] == 'Success'){

         $coupon =  $result['coupons'];

        for ( $i = 0; $i < count($coupon->data); $i++) {

          $couponArray[$i]['id']   = $coupon->data[$i]['id'];
          $couponArray[$i]['name'] = $coupon->data[$i]['name'];
          $couponArray[$i]['percent_off'] = $coupon->data[$i]['percent_off'];
          $couponArray[$i]['duration'] = $coupon->data[$i]['duration'];
          $couponArray[$i]['duration_in_months'] = $coupon->data[$i]['duration_in_months'];
         
        }
  
        $coupons = json_decode(json_encode($couponArray), FALSE);
  
        return view('stripe.coupon.index', ['coupons' => $coupons ]);

      } else {

         session()->flash('error', $result['message']);
 
         return redirect()->back();

      }

      return view('stripe.coupon.index');

   }  // end of indexCoupons

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
   {
        
      return view('stripe.coupon.create');

   }

   /**
     * Store a newly created coupon in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
   */

   public function store(StoreStripeCouponRequest $request)
   {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->createCoupon($request->percent, $request->duration, $request->name, $request->months);

      if ($result['message'] == 'Success'){

         session()->flash('success', 'Coupon created successfully.');
         
         return redirect(route('coupons.index'));

      } else {

         session()->flash('error', $result['message']);
 
         return redirect()->back();

      }

   }  // end of storeCoupon

   /**
     * Display the specified coupon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
   */

   public function show($id)
   {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->findCoupon($id);

      if ($result['message'] == 'Success'){

         return new StripeCouponResource($result['coupon']);

      } else {

         session()->flash('error', $result['message']);
 
         return redirect()->back();
      }

   }  // end of showCoupon

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

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->findCoupon($id);

      if ($result['message'] == 'Success'){

         $coupon =  $result['coupon'];
      
         $couponArray[0]['id']   = $coupon->id;
         $couponArray[0]['name'] = $coupon->name;
         $couponArray[0]['percent_off'] = $coupon->percent_off;
         $couponArray[0]['duration'] = $coupon->duration;
         $couponArray[0]['duration_in_months'] = $coupon->duration_in_months; 
   
         $coupon = json_decode(json_encode($couponArray), FALSE);
   
         return view('stripe.coupon.create', ['coupon' => $coupon ]);
         

      } else {

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

    public function update(UpdateStripeCouponRequest $request)
    {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->createCoupon($request->percent, $request->duration, $request->name, $request->months);

      if ($result['message'] == 'Success'){

         session()->flash('success', 'Coupon updated successfully.');
         
         return redirect(route('coupons.index'));

      } else {

         session()->flash('error', $result['message']);
 
         return redirect()->back();

      }
        
    }

    /**
     * Remove the specified coupon from Stripe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($couponId)
    {

       $stripeService = new StripeService();
       $stripeService->setStripeKey();

       $couponId = trim($couponId);

       $stripeSubscriptionService = new StripeSubscriptionService();
       $result = $stripeSubscriptionService->deleteCoupon($couponId);

       if ($result['message'] == 'Success'){

         session()->flash('success', 'Coupon deleted successfully.');
         
        return redirect( route ('coupons.index') );

       } else {

         session()->flash('error', $result['message']);
 
         return redirect()->back();

       }

    }  // end of destroyCoupon
}
