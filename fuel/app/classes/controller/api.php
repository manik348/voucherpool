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
class Controller_Api extends Controller_Template
{
	/**
	 * The API documentation page
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
        $data = array();
        $this->template->title = "API Documentation";
        $this->template->content = \View::forge('api/index', $data);
	}


}
