<?php
class Item extends AppModel
{
	public $useTable = 'item';

	public function getItem( $item_id )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'id' => $item_id,
			),
		) );
	}
}
?>
