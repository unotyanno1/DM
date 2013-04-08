<?php
class GameNumberLogic extends AppModel
{
	public $useTable = 'game_number_logic';

	public function getGameNumberLogic( $floor )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
