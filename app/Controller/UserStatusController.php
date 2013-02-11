<?php 
class UserStatusController extends AppController
{
	public $uses = array( 'UserStatus', 'Level' );

	public function get_status()
	{
		if( $this->request->query[ 'user_id' ] != null  ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$results = $this->UserStatus->getStatus( $user_id );
			$level_data = $this->Level->getLevelDesc( $results['UserStatus']['level'] );
			$results['UserStatus']['level_description'] = $level_data['Level']['description'];
			debug( $results );
			//$this->set( 'results', $results );
			//$this->viewClass = 'Json';
			//$this->set( '_serialize', array( 'results' ) );
		}
	}
	
	public function add_status( $user_id )
	{
		$this->UserStatus->addStatus( $user_id );
	}
	
	public function update_quest_progress()
	{
		if( $this->request->query[ 'user_id' ] != null && $this->request->query[ 'quest_progress' ] != null  ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$quest_progress = $this->request->query[ 'quest_progress' ];
			$this->UserStatus->updateQuestProgress( $user_id, $quest_progress );
			$results = $this->UserStatus->getStatus( $user_id );
			$level_data = $this->Level->getLevelDesc( $results['UserStatus']['level'] );
			$results['UserStatus']['level_description'] = $level_data['Level']['description'];
			debug( $results );
		}	
	}
}
?>
