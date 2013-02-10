<?php
class UserHasItem extends AppModel
{
	public $useTable = 'user_has_item';

	public function getUserHasAllItem( $user_id )
	{
		return $this->find( 'all', array(
			'conditions' => array(
				'user_id' => $user_id,
			),
		) );
	}

	public function addUserHasItem( $user_id, $item_id )
	{
		$sql = sprintf( 'insert into %s ( user_id, item_id, created, modified ) values ( ?, ?, now(), now() )', $this->useTable );
		$this->query( $sql, array(
			$user_id,
			$item_id
		) );
	}

	public function deleteUserHasItem( $user_id, $item_id )
	{
		$sql = sprintf( 'delete from %s where user_id = ? and item_id = ?', $this->useTable );
		$this->query( $sql, array(
			$user_id,
			$item_id
		) );
	}
}
?>
