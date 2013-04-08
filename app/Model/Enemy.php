<?php 
class Enemy extends AppModel
{
	public $useTable = 'enemy';

	public function getEnemy( $floor )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
