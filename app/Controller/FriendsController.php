<?php
class FriendsController extends AppController
{
	public $uses = array( 'Friend', 'User', 'UserStatus' );

	public function get_ranking()
	{
		if( $this->request->query[ 'user_id' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$results = $this->Friend->getFriend( $user_id );
			foreach( $results as $i => $result )
			{
				$friend_data = $this->User->getUser( $result['Friend']['friend_id'] );
				$results[$i]['Friend']['friend_name'] = $friend_data['User']['name'];
				$quest_data = $this->UserStatus->getStatus( $result['Friend']['friend_id'] );
				$results[$i]['Friend']['quest_progress'] = $quest_data['UserStatus']['quest_progress'];

			}
			$user_data = $this->UserStatus->getStatus( $user_id );
			$user_name_data = $this->User->getUser( $user_id );
			$user_data['UserStatus']['name'] = $user_name_data['User']['name'];
			$results[count($results)]['User'] = $user_data['UserStatus'];
			$results = Set::sort( $results, '{n}.{s}.quest_progress', 'desc' );
			debug( $results );
		}
	}
}
?>
