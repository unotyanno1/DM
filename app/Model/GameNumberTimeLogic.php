<?php
class GameNumberTimeLogic extends AppModel
{
	public $useTable = 'game_number_time_logic';

	public function getGameNumberTimeLogic( $floor, $party )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'floor' => $floor,
				'party' => $party,
			),
		) );
	}
}
?>
