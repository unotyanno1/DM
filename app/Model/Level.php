<?php
class Level extends AppModel
{
	public $useTable = 'level';

	public function getLevelDesc( $level )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'level' => $level,
			),
		) );
	}
}
?>
