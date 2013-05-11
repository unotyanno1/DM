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
		$sql = sprintf( 'insert into %s 
					( 
						user_id, 
						level, 
						lp, 
						atk, 
						rcr, 
						quest_progress, 
						created, 
						modified 
					) values ( 
						?, 
						?, 
						?, 
						?, 
						?, 
						?, 
						now(), 
						now() )', 
						$this->useTable );
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
		$sql = sprintf( 'update %s set level = level, lp = lp + ?, atk = atk + ?, rcr = rcr + ?, quest_progress = quest_progress + 1, modified = now() where user_id = ?', $this->useTable );
		return $this->query( $sql, array(
			$lp,
			$atk,
			$rcr,
			$user_id
		) );
	}

	/*
	 * クエスト進捗を更新する
	 * @param	$user_id
	 * @param	$floor		クリアしたフロアNo
	 */
	public function updateQuestProgress( $user_id, $floor )
	{
		$sql = sprintf( 'update %s set quest_progress = ?, modified = now() where user_id = ?', $this->useTable );
		$this->query( $sql, array(
			$floor,
			$user_id
		) );
	}
}
?>
