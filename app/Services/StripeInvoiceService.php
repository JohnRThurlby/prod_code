<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Http\Resources\BusinessUnit as BusinessUnitResource;

use App\Models\BusinessUnit;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class StripeInvoiceService
{

    /**
     * Find a single Stripe Invoice.
     *
     * @param  $invoice_id
     */

    public function findInvoice(string $invoice_id)
    {

        $message = 'Success';
        $invoice = '';

        // Find an invoice

        try {

          $invoice  = \Stripe\Invoice::retrieve
          (
            $invoice_id
          );

          Log::debug("FIND INVOICE");
          return $invoice;

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

            $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'invoice' => $invoice);

    }  // end function findInvoice

    /**
     * Find a Customers Stripe Invoices.
     *
     * @param  $businessUnit
     */

    public function findCustomerInvoices($businessUnit)
    {

        $message = 'Success';
        $invoices = '';

        // Find an customers invoices

        try {

          $invoices = $businessUnit->invoicesIncludingPending();

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'invoices' => $invoices);

    }  // end function findCustomerInvoices

    /**
     * List all Stripe Invoices.
     *
     * @param
     */

    public function listInvoices()
    {

        $message = 'Success';
        $invoices = '';

        // List all invoices

        try {

          $invoices = \Stripe\Invoice::all(

            ['limit' => 5]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'invoices' => $invoices);

    }  // end function listInvoices

    /**
     * List all Stripe Early Fraud Warnings
     *
     * @param
     */

    public function listFraudWarnings()
    {

        $message = 'Success';
        $frauds = '';

        // List all fraud warnings

        try {

          $frauds = \Stripe\Radar\EarlyFraudWarning::all(

            ['limit' => 5]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'frauds' => $frauds);

    }  // end function listFraudWarnings

    /**
     * Find a single Stripe Early Fraud Warning
     *
     * @param  $fraud_id
     */

    public function findFraudWarning(string $fraud_id)
    {

        $message = 'Success';
        $fraud = '';

        // List fraud warning

        try {

          $fraud = \Stripe\Radar\EarlyFraudWarning::retrieve(

            $fraud_id

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'fraud' => $fraud);

    }  // end function findFraudWarning

    /**
     * Find a Stripe Charge
     *
     * @param  $charge_id
     */

    public function findCharge(string $charge_id)
    {

        $message = 'Success';
        $charge = '';

        // Find a charge

        try {

          $charge = \Stripe\Charge::retrieve(

            $charge_id

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'charge' => $charge);

    }  // end function findCharge

    /**
     * Find a Stripe Refund.
     *
     * @param  $refund_id
     */

    public function findRefund(string $refund_id)
    {

        $message = 'Success';
        $refund  = '';

        // Find a refund

        try {

          $refund  = \Stripe\Refund::retrieve
          (
            $refund_id
          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'refund' => $refund);

    }  // end function findRefund

    /**
     * List all Stripe Refunds.
     *
     * @param
     */

    public function listRefunds()
    {

        $message = 'Success';
        $refunds  = '';

        // List all refunds

        try {

          $refunds = \Stripe\Refund::all(

            ['limit' => 5]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'refunds' => $refunds);

    }  // end function listRefunds

    /**
     * List all Stripe Charges.
     *
     * @param
     */

    public function listCharges()
    {

        $message = 'Success';
        $charges = '';

        // List all charges

        try {

          $charges = \Stripe\Charge::all(

            ['limit' => 10]

          );

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'charges' => $charges);

    }  // end function listCharges

    /**
     * Create a Stripe Refund.
     *
     * @param $charge_id
     */

    public function createRefund($businessUnit, string $charge_id)
    {

        $message = 'Success';
        $refund = '';

        // Create a refund

        try {

          $refund = $businessUnit->refund($charge_id);

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'refund' => $refund);

    }  // end function createRefund

    /**
     * Create a single Stripe Charge.
     *
     * @param $charge_id
     */

    public function createCharge($businessUnit, string $invoice_description, string $amount)
    {

        $message = 'Success';
        $charge = '';

        // Create a single charge

        try {

          $charge = $businessUnit->invoiceFor($invoice_description, $amount);

        } catch (\Stripe\Exception\ApiErrorException $e) {

          $message = $e->getError()->message;

        } catch (Exception $e) {

          $message = $e->getError()->message;

        } // end catch

        return array(
          'message' => $message,
          'charge' => $charge);

    }  // end function createCharge

}
