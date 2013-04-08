<?php
class GameBombLogic extends AppModel
{
	public $useTable = 'game_bomb_logic';

	public function getGameBombLogic( $floor )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'floor' => $floor,
			),
		) );
	}
}
?>
