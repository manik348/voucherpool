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
 * The Offers Controller.
 *
 * This controller is reponsible for offers management.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Offers extends Controller_Template
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
	    $data["offers"] = \Model_Offer::find('all');
        $this->template->title = "Offers";
        $this->template->content = \View::forge('offers/index', $data);
	}

    public function action_table()
    {
        $data = array();
        $list = \Model_Offer::find('all');
        foreach ($list as $item) {
            $columns = $item->to_array();
            $columns["action"] = '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <i class="fa fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item offer-edit-btn" data-id="'.$columns["id_offer"].'"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                    <a class="dropdown-item offer-delete-btn" data-id="'.$columns["id_offer"].'"><i
                                                class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>';
            $data["data"][] = array_values($columns);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        return false;
    }

    public function action_list()
    {
        $data = array();
        $list = \Model_Offer::find('all');
        foreach ($list as $item) {
            $columns["value"] = $item->id_offer;
            $columns["name"] = $item->name;
            $data["data"][] = $columns;
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        return false;
    }

    public function action_get($id)
    {
        echo json_encode(\Model_Offer::find($id)->to_array());
        return false;
    }

    public function action_set()
    {
        if (!empty($_POST["id_offer"])) {
            // update
            $record = \Model_Offer::find($_POST["id_offer"]);
            $record->name = $_POST["name"];
            $record->discount = $_POST["discount"];
        } else {
            // new
            $record = \Model_Offer::forge($_POST);
            $record->id_offer = null;
        }

        echo ($record->save()) ? '1':'0';
        return false;
    }

    public function action_del($id)
    {
        $record = \Model_Offer::find($id);
        echo ($record->delete()) ? '1':'0';
        return false;
    }

}
