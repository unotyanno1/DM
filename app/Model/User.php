<?php 
class User extends AppModel
{
	public $useTable = 'users';

	public function getUser( $user_id )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'user_id' => $user_id,
			),
		) );
	}
	
	public function getUserFbId( $fb_id_list )
	{
		$pres_str = '';
		$fb_id_str = '';
		foreach( $fb_id_list as $fb_id )
		{
			$pres_str .= '?,';
		}
		$pres_str = substr( $pres_str, 0, -1 );
		$sql = sprintf( 'select * from %s where fb_id in ( ' . $pres_str . ' ) ', $this->useTable );

		return $this->query( $sql, $fb_id_list );
	}

	public function getInviteUser( $invite_id )
	{
		return $this->find( 'first', array(
			'conditions' => array(
				'invite_id' => $invite_id,
			),
		) );
	}
	
	public function addUser()
	{
		$id = $this->getRandId();
		$chk_key = md5( $id );
		$sql = sprintf( 'insert into %s ( user_id, fb_id, chk_key, created, modified ) values ( ?, ?, ?, now(), now() )', $this->useTable );
		$this->query( $sql, array(
			$id,
			$id,
			$chk_key
		) );
		$ret = array( 'user_id'=> $id, 'chk_key'=>$chk_key );
		return $ret;
	}
	
	public function updateUserFbId( $user_id, $fb_id, $chk_key )
	{
		$sql = sprintf( 
			'update %s
		       		set 
					fb_id = ?, 
					modified = now() 
				where
					user_id = ?
				and
					chk_key = ?
			', 
				$this->useTable );
		$this->query( $sql, array(
			$fb_id,
			$user_id,
			$chk_key
		) );
	}

	public function deleteUser( $user_id )
	{
		
	}
	
	public function getRandId()
	{
		$seed = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
		$len = 12;
		$user_id = '';
		while($len--)
		{
			$user_id .= $seed[mt_rand(0, ( count( $seed ) -1 ) )];
		}
		return $user_id;
	}	
}
?>
