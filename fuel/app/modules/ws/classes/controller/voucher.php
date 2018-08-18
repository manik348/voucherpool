<?php

namespace ws;

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Voucher Webservice Controller.
 *
 * This controller is reponsible for vouchers webservice
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Voucher extends \Controller_Rest
{
    /**
     * The valitation voucher routine
     *
     * @access  public
     * @return  Response
     */
    public function post_validate()
    {

        $code = \Input::get('code');
        $email = \Input::get('email');

        if (!empty($code) && !empty($email)) {

            // Try to find this voucher based in the recipient's email and voucher code
            $result = \DB::select()
                ->from('voucher')
                ->join('recipient', 'LEFT')->on('voucher.id_recipient', '=', 'recipient.id_recipient')
                ->join('offer', 'LEFT')->on('voucher.id_offer', '=', 'offer.id_offer')
                ->where('voucher.code', $code)// requested voucher code
                ->where('recipient.email', $email)// requested email
                ->execute();

            // if we have found this voucher...
            if (count($result) > 0) {

                // Get a model object of this voucher to easily manipulate
                $voucher = \Model_Voucher::find($result[0]["id_voucher"]);

                // Checks if voucher has already expired
                if (strtotime($voucher->date_expiration) <= date("Y-m-d")) {  // expiration date must be less or equal to today
                    return $this->response(array(
                        "return" => "3",
                        "message" => "Voucher is expired."
                    ), 422);
                } else if (!empty($voucher->date_usage)) {
                    return $this->response(array(
                        "return" => "4",
                        "message" => "Voucher is already used."
                    ), 422);
                } else {
                    // voucher is valid, not used and can be used now...

                    // Mark this voucher as used with today' date
                    $voucher->date_usage = date("Y-m-d");
                    $voucher->save();

                    return $this->response(array(
                        "return" => "0",
                        "discount" => $voucher->offer->discount
                    ));
                }

            } else {
                // We could not find this voucher
                return $this->response(array(
                    "return" => "2",
                    "message" => "Voucher not found."
                ), 404);
            }

        } else {

            // One or more input parameters were missing
            return $this->response(array(
                "return" => "1",
                "message" => "Please inform voucher code and email."
            ), 422);

        }

    }

    public function post_list()
    {

        $email = \Input::get('email');

        if (!empty($email)) {

            // Try to find this voucher based in the recipient's email and voucher code
            $result = \DB::select()
                ->from('voucher')
                ->join('recipient', 'LEFT')->on('voucher.id_recipient', '=', 'recipient.id_recipient')
                ->join('offer', 'LEFT')->on('voucher.id_offer', '=', 'offer.id_offer')
                ->where('recipient.email', $email)// requested email
                ->where('voucher.date_expiration', '>=', \DB::expr('CURDATE()'))  // expiration date must be < than today
                ->where('voucher.date_usage', 'IS', null)    // usage date must be empty
                ->execute();

            if (count($result) > 0) {

                $vouchers = array();
                $i = 0;
                foreach ($result as $r) {

                    // Get a model object of this voucher to easily manipulate
                    $voucher = \Model_Voucher::find($r["id_voucher"]);
                    $vouchers[$i]["code"] = $voucher->code;
                    $vouchers[$i]["offer"] = $voucher->offer->name;
                    $i++;

                }

                // One or more input parameters were missing
                return $this->response(array(
                    "return" => "0",
                    "vouchers" => $vouchers
                ));

            } else {

                return $this->response(array(
                    "return" => "2",
                    "message" => "No valid vouchers found."
                ), 404);

            }

        } else {

            // One or more input parameters were missing
            return $this->response(array(
                "return" => "1",
                "message" => "Please inform recipient's email."
            ), 422);

        }


    }

}
