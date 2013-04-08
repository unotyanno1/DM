<?php
class GameBombTimeLogic extends AppModel
{
	public $useTable = 'game_bomb_time_logic';

	public function getGameBombTimeLogic( $floor )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
