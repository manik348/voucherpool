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
 * The Dashboard Controller.
 *
 * This is the first page seen by the user. It gives an overview of the current status of the system.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Dashboard extends Controller_Template
{
	/**
	 * The dashboard page - default home page
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
        $data = array();

        // Four top widgets
        $data["total_recipients"] = count(\Model_Recipient::find('all'));
        $data["total_offers"] = count(\Model_Offer::find('all'));
        $data["total_vouchers"] = count(\Model_Voucher::find('all'));
        $data["total_vouchers_used"] = count(\Model_Voucher::find('all', array('where' => array(array('date_usage', 'IS NOT', null)))));

        // Vouchers by status - Pie Chart
        $data["vouchers_used"] = count(\Model_Voucher::find('all', array('where' => array(array('date_usage', 'IS NOT', null)))));
        $data["vouchers_unused"] = count(\Model_Voucher::find('all', array('where' => array(array('date_usage', 'IS', null), array('date_expiration', '>=', \DB::expr('CURDATE()'))))));    // not used and not expired
        $data["vouchers_expired"] = count(\Model_Voucher::find('all', array('where' => array(array('date_expiration', '<=', \DB::expr('CURDATE()')), array('date_usage', 'IS', null)))));   // not used and expired

        // Vouchers grouped by usage date - Line Chart
        $usage_by_date = \DB::select(DB::expr('COUNT(*) as count, date_usage'))
                        ->from('voucher')
                        ->where('date_usage', 'IS NOT', NULL)
                        ->group_by('date_usage')
                        ->execute();
        $data["vouchers_usage"] = $usage_by_date->as_array();

        // Get the latest 5 vouchers created
        $data["list_vouchers_created"] = \Model_Voucher::find('all', array(
            'where' => array(
                array('date_usage', 'IS', NULL),
            ),
            'order_by' => array('date_usage' => 'desc'),
            'limit' => 5
        ));

        // Get the latest 5 vouchers used
        $data["list_vouchers_used"] = \Model_Voucher::find('all', array(
            'where' => array(
                array('date_usage', 'IS NOT', NULL),
            ),
            'order_by' => array('id_voucher' => 'desc'),
            'limit' => 5
        ));

        $this->template->title = "Dashboard";
        $this->template->content = \View::forge('dashboard/index', $data);
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
        $data = array();
        $this->template->title = "Page Not Found";
        $this->template->content = \View::forge('dashboard/404', $data);
	}
}
