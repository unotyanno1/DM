<?php
class Friend extends AppModel
{
	public $useTable = 'friends';

	public function getFriend( $user_id )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'user_id' => $user_id,
			),
		) );
	}

	public function addFriend( $user_id, $friend_id )
	{
		$sql = sprintf( 'insert into %s ( user_id, friend_id, created ) values ( ?, ?, now() )', $this->useTable );
		$this->query( $sql, array(
			$user_id,
			$friend_id
		) );
	}
}
?>
