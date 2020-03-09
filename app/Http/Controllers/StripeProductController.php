<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StripeService;
use App\Services\StripeSubscriptionService;

use App\Http\Requests\StoreStripeProductRequest;
use App\Http\Requests\UpdateStripeProductRequest;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class StripeProductController extends Controller
{

  public function __construct() 
    {

        // $this->middleware(['auth', 'verified'])->only([ 'create', 'store' ]);
   
    }
    
   /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->listProducts();

      if ($result['message'] == 'Success'){

        $product =  $result['products'];

        for ( $i = 0; $i < count($product->data); $i++) {
     
          $prodArray[$i]['id'] = $product->data[$i]['id'];
          $prodArray[$i]['name'] = $product->data[$i]['name'];
         
        }
  
        $products = json_decode(json_encode($prodArray), FALSE);
  
        return view('stripe.product.index', ['products' => $products ]);

      } else {

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    }   // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

      return view('stripe.product.create');

    }

    /**
     * Store a newly created product in Stripe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreStripeProductRequest $request)
    {

        $stripeService = new StripeService();
        $stripeService->setStripeKey();

        $stripeSubscriptionService = new StripeSubscriptionService();
        $result = $stripeSubscriptionService->createProduct($request->name);

        if ($result['message'] == 'Success'){

         session()->flash('success', 'Product created successfully.');
         
         return redirect( route ('products.index') );

         } else {

            session()->flash('error', $result['message']);

            return redirect()->back();

         }

    }  // end of store

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

       //

    }  // end of show

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
      $result = $stripeSubscriptionService->findProduct($id);

      if ($result['message'] == 'Success'){

        $product =  $result['product'];

        $prodArray[0]['id'] = $product->id;
        $prodArray[0]['name'] = $product->name;
  
        $product = json_decode(json_encode($prodArray), FALSE);
        
        return view('stripe.product.create', ['product' => $product ]);

      } else {

         session()->flash('error', $result['message']);

         return redirect()->back();

      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {

      Log::debug('IN UPDATE');
      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->updateProduct($request->product_id, $request->name);

      if ($result['message'] == 'Success'){

       session()->flash('success', 'Product updated successfully.');
       
       return redirect( route ('products.index') );

      } else {

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    }

    /**
     * Remove the specified product from Stripe.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

      $stripeService = new StripeService();
      $stripeService->setStripeKey();

      $stripeSubscriptionService = new StripeSubscriptionService();
      $result = $stripeSubscriptionService->deleteProduct($id);

      if ($result['message'] == 'Success'){

        session()->flash('success', 'Product deleted successfully.');
         
        return redirect( route ('products.index') );

      } else {

        session()->flash('error', $result['message']);

        return redirect()->back();

      }

    }  // end of destroy
}
