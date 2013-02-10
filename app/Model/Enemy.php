<?php 
class Enemy extends AppModel
{
	public $useTable = 'enemy';

	public function getEnemy( $floor )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
