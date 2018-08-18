<?php
/**
 * Controller Post class tests
 *
 * @group Controller
 * @group Offers
 */

use PHPUnit\Framework\TestCase;

class Test_Controller_Offers extends TestCase
{
    public function test_view_Offers_list()
    {
        $response = Request::forge('offers/index')
            ->set_method('GET')
            ->execute()
            ->response();

        $this->assertEquals("", Response:: get_redirect_url());
    }

    public function test_create_Offers()
    {
        $count = count(Model_Offer::find("all"));

        $_POST["name"] = "Test Christmas Offer 20%"; //
        $_POST["discount"] = "20%";

        $response = Model_Offer::forge($_POST)
            ->save();

        //$this->assertTag (array ( 'Tag'  =>  'Strong' ,  'Content'  => 'Success' ), $response->Body-> __ToString ());  // ￩ normal at the end of Flash message
        $this->assertEquals($count + 1, count(Model_Offer:: find("all")));  // ← insert is executed and confirm that one record is added
    }

    public function test_delete_Offers()
    {

        $name = "Test Christmas Offer 20%";

        $count = count(Model_Offer::find("all"));

        $offer_id = \DB::select('id_offer')->from("offer")->where("name", $name)->as_object()->execute();

        $response = Model_Offer::find($offer_id[0]->id_offer)->delete();

        $updated_offer = \DB::select()->from("offer")->where("name", $name)->execute();

        $this->assertEquals(0, count($updated_offer));
        //$this->assertEquals("302", Response::get_redirect_status());
        $this->assertEquals($count - 1, count(Model_Offer::find("all")));
    }
}