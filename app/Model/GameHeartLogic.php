<?php
class GameHeartLogic extends AppModel
{
	public $useTable = 'game_heart_logic';

	public function getGameHeartLogic( $floor )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
