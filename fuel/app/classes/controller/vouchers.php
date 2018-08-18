<?php
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
 * The Recipients Controller.
 *
 * This controller is reponsible for recipients management.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Vouchers extends Controller_Template
{
	/**
	 * The main action
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
	    $data = array();
	    $data["vouchers"] = \Model_Voucher::find('all');
        $this->template->title = "Vouchers";
        $this->template->content = \View::forge('vouchers/index', $data);
	}

    public function action_table()
    {
        $data = array();
        $list = \Model_Voucher::find('all');
        foreach ($list as $item) {
            $item->id_recipient = $item->recipient->name;
            $item->id_offer = $item->offer->name;
            $item->date_usage = (empty($item->date_usage)) ? "Not Used":$item->date_usage;
            $columns = $item->to_array();
            array_splice($columns, 6, 2); // clear unused items in listing

            $columns["actions"] = '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item voucher-edit-btn" data-id="'.$columns["id_voucher"].'"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                    <a class="dropdown-item voucher-delete-btn" data-id="'.$columns["id_voucher"].'"><i
                                                class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>';
            $data["data"][] = array_values($columns);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        return false;
    }

    public function action_get($id)
    {
        echo json_encode(\Model_Voucher::find($id)->to_array());
        return false;
    }

    public function action_set()
    {
        if (!empty($_POST["id_voucher"])) {
            // update
            $record = \Model_Voucher::find($_POST["id_voucher"]);
            $record->id_recipient = $_POST["id_recipient"];
            $record->id_offer = $_POST["id_offer"];
            $record->date_expiration = $_POST["date_expiration"];
            $record->date_usage = (!empty($_POST["date_usage"])) ? $_POST["date_usage"] : NULL;     // not null
            $record->code = $_POST["code"];
        } else {
            // new
            $record = \Model_Voucher::forge($_POST);
            $record->id_voucher = null;
            $record->date_usage = (!empty($_POST["date_usage"])) ? $_POST["date_usage"] : NULL;     // not null
        }

        echo ($record->save()) ? '1':'0';
        return false;
    }

    public function action_del($id)
    {
        $record = \Model_Voucher::find($id);
        echo ($record->delete()) ? '1':'0';
        return false;
    }

    public function action_generate()
    {

        /* For a given Special Offer and an expiration date generate for each Recipient a
           Voucher Code
        */

        $id_offer = Input::post("id_offer_gen");
        $expiration_date = Input::post("date_expiration");

        $recipients = \Model_Recipient::find('all');

        // Loop between recipients to create the vouchers
        foreach ($recipients as $r) {

            // Create a new voucher record
            $voucher = new \Model_Voucher();
            $voucher->id_recipient = $r->id_recipient;
            $voucher->id_offer = $id_offer;
            $voucher->date_expiration = $expiration_date;
            $voucher->date_usage = NULL;
            $voucher->code = $this->generateVoucherCode();  // generate random code

            $voucher->save();

        }

        Session::set_flash("success", "All vouchers have been generated sucessfully.");
        Response::redirect_back();

    }

    private function generateVoucherCode($length = 8) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $code = substr(str_shuffle($chars), 0, $length);
        return $code;
    }

}
