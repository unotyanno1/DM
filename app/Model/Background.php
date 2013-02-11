<?php
class Background extends AppModel
{
	public $useTable = 'background';

	public function getBackground( $floor )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
