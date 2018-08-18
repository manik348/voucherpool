<?php
use Orm\Model;

class Model_Offer extends Model
{
	protected static $_properties = array(
		'id_offer',
		'name',
        'discount'
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('id_offer', 'ID', 'required|valid_string[numeric]');
		$val->add_field('name', 'Name', 'required|max_length[45]');
        $val->add_field('discount', 'Discount', 'required|decimal');

		return $val;
	}

	protected static $_table_name = 'offer';
	protected static $_primary_key = array('id_offer');
	
}
