<?php
/**
 * Controller Post class tests
 *
 * @group Controller
 * @group Recipient
 */

use PHPUnit\Framework\TestCase;

class Test_Controller_Recipient extends TestCase
{
    public function test_view_recipient_list()
    {
        $response = Request::forge('recipients/index')
            ->set_method('GET')
            ->execute()
            ->response();

        $this->assertEquals("", Response:: get_redirect_url());
    }

    public function test_create_recipient()
    {
        $count = count(Model_Recipient::find("all"));

        $_POST["name"] = "test_user";
        $_POST["email"] = "test@gmail.com";

        $response = Model_Recipient::forge($_POST)
            ->save();

        //$this->assertTag (array ( 'Tag'  =>  'Strong' ,  'Content'  => 'Success' ), $response->Body-> __ToString ());  // ￩ normal at the end of Flash message
        $this->assertEquals($count + 1, count(Model_Recipient:: find("all")));  // ← insert is executed and confirm that one record is added
    }

    public function test_delete_recipient()
    {

        $email = "test@gmail.com";

        $count = count(Model_Recipient::find("all"));

        $rec_id = \DB::select('id_recipient')->from("recipient")->where("email", $email)->as_object()->execute();

        $response = Model_Recipient::find($rec_id[0]->id_recipient)->delete();

        $updated_user = \DB::select()->from("recipient")->where("email", $email)->execute();

        $this->assertEquals(0, count($updated_user));
        //$this->assertEquals("302", Response::get_redirect_status());
        $this->assertEquals($count - 1, count(Model_Recipient::find("all")));
    }
}