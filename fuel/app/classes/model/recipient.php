<?php
use Orm\Model;

class Model_Recipient extends Model
{
	protected static $_properties = array(
		'id_recipient',
		'name',
        'email'
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('id_recipient', 'ID', 'required|valid_string[numeric]');
		$val->add_field('name', 'Name', 'required|max_length[45]');
        $val->add_field('email', 'E-mail', 'required|max_length[65]|email');

		return $val;
	}

	protected static $_table_name = 'recipient';
	protected static $_primary_key = array('id_recipient');
	
}
