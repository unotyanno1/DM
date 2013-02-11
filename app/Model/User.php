<?php 
class User extends AppModel
{
	public $useTable = 'users';

	public function getUser( $user_id )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'id' => $user_id,
			),
		) );
	}

	public function getInviteUser( $invite_id )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'invite_id' => $invite_id,
			),
		) );
	}
	
	public function addUser( $name )
	{
		$id = $this->getRandId();
		$sql = sprintf( 'insert into %s ( id, name, invite_id, created, modified ) values ( ?, ?, ?, now(), now() )', $this->useTable );
		$this->query( $sql, array(
			$id,
			$name,
			$id
		) );
		return $id;
	}

	public function deleteUser( $user_id )
	{
		
	}
	
	public function getRandId()
	{
		$seed = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
		$len = 8;
		$user_id = '';
		while($len--)
		{
			$user_id .= $seed[mt_rand(0, ( count( $seed ) -1 ) )];
		}
		return $user_id;
	}	
}
?>
