<?php
use Orm\Model;

class Model_Voucher extends Model
{
	protected static $_properties = array(
		'id_voucher',
		'id_recipient',
		'id_offer',
		'date_expiration',
		'date_usage',
		'code'
	);

    protected static $_belongs_to = array(
        'recipient' => array(
            'key_from' => 'id_recipient',
            'model_to' => 'Model_Recipient',
            'key_to' => 'id_recipient',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
        'offer' => array(
            'key_from' => 'id_offer',
            'model_to' => 'Model_Offer',
            'key_to' => 'id_offer',
            'cascade_save' => false,
            'cascade_delete' => false,
        )
    );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('id_voucher', 'ID', 'required|valid_string[numeric]');
        $val->add_field('id_recipient', 'ID Recipient', 'required|valid_string[numeric]');
        $val->add_field('id_offer', 'ID Offer', 'required|valid_string[numeric]');
		$val->add_field('date_expiration', 'Expiration Date', 'valid_date');
        $val->add_field('only_once', 'Only Once', 'required');
        $val->add_field('date_usage', 'Date Used', 'valid_date');
        $val->add_field('track_usage', 'Track Usage', 'required');
        $val->add_field('code', 'Code', 'required');

		return $val;
	}

	protected static $_table_name = 'voucher';
	protected static $_primary_key = array('id_voucher');
	
}
