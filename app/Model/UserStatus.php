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
	
	public function UpdateStatus( $user_id, $lp, $atk, $rcr )
	{
		$sql = sprintf( 'update %s set level = level + 1, lp = lp + ?, atk = atk + ?, rcr = rcr + ?, quest_progress = quest_progress + 1, modified = now() where user_id = ?', $this->useTable );
		return $this->query( $sql, array(
			$lp,
			$atk,
			$rcr,
			$user_id
		) );
	}
	
	public function updateQuestProgress( $user_id, $quest_progress )
	{
		$sql = sprintf( 'update %s set quest_progress = ?, level = ?, modified = now() where user_id = ?', $this->useTable );
		$this->query( $sql, array(
			$quest_progress,
			$quest_progress,
			$user_id
		) );
	
	}
}
?>
