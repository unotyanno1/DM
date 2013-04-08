<?php
class GameHeartTimeLogic extends AppModel
{
	public $useTable = 'game_heart_time_logic';

	public function getGameHeartTimeLogic( $floor )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
