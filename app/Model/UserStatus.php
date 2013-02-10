<?php
class UserStatus extends AppModel
{
	public $useTable = 'user_status';

	public function getStatus( $user_id )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'user_id' => $user_id,
			),
		) );
	}

	public function addStatus( $user_id )
	{
		$sql = sprintf( 'insert into %s ( user_id, level, hp, attack, defense, quest_progress, created, modified ) values ( ?, ?, ?, ?, ?, ?, now(), now() )', $this->useTable );
		return $this->query( $sql, array(
			$user_id,
			1,
			50,
			10,
			5,
			0,
		) );
	}
	
	public function updateQuestProgress( $user_id, $quest_progress )
	{
		$sql = sprintf( 'update %s set quest_progress = ?, level = ? where user_id = ?', $this->useTable );
		$this->query( $sql, array(
			$quest_progress,
			$quest_progress,
			$user_id
		) );
	
	}
}
?>
