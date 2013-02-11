<?php
class InviteStatus extends AppModel
{
	public $useTable = 'invite_status';

	public function getInviteStatus( $user_id )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'user_id' => $user_id,
			),
		) );
	}

	public function addInviteStatus( $user_id, $friend_id, $invite_id )
	{
		$sql = sprintf( 'insert into %s ( user_id, friend_id, invite_id, status, created, modified ) values ( ?, ?, ?, ?, now(), now() )', $this->useTable );
		$this->query( $sql, array(
			$user_id,
			$friend_id,
			$invite_id,
			1
		) );
	}

	public function updateInviteStatus( $user_id, $friend_id, $status )
	{
		$sql = sprintf( 'update %s set status = ?, modified = now() where user_id = ? and friend_id = ?', $this->useTable );
		$this->query( $sql, array(
			$status,
			$user_id,
			$friend_id
		) );
	}
}
?>
