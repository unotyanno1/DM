<?php
class InviteStatusController extends AppController
{
	public $uses = array( 'InviteStatus', 'User', 'Friend' );

	public function get_status()
	{
		if( $this->request->query[ 'user_id' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$results = $this->InviteStatus->getInviteStatus( $user_id );
			debug( $results );
		}
	}

	public function add_status()
	{
		if( $this->request->query[ 'user_id' ] != null && $this->request->query[ 'invite_id' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$invite_id = $this->request->query[ 'invite_id' ];
			$user_data = $this->User->getInviteUser( $invite_id );
			$friend_id = $user_data['User']['id'];
			$this->InviteStatus->addInviteStatus( $user_id, $friend_id, $invite_id );
		}
	}

	public function update_status()
	{
		if( $this->request->query[ 'friend_id' ] != null && $this->request->query[ 'user_id' ] != null && $this->request->query[ 'status' ] != null ) 
		{
			$friend_id = $this->request->query[ 'friend_id' ];
			$user_id = $this->request->query[ 'user_id' ];
			$status = $this->request->query[ 'status' ];
			$this->InviteStatus->updateInviteStatus( $user_id, $friend_id, $status );
			if( $status == 2 ) 
			{
				$this->Friend->addFriend( $user_id, $friend_id );	
				$this->Friend->addFriend( $friend_id, $user_id );	
			}
		}
	}
}
?>
