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
	
	public function update_status( )
	{
		if( $this->request->query[ 'user_id' ] != null && $this->request->query[ 'lp' ] != null && $this->request->query[ 'atk' ] != null && $this->request->query[ 'rcr' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$lp = $this->request->query[ 'lp' ];
			$atk = $this->request->query[ 'atk' ];
			$rcr = $this->request->query[ 'rcr' ];
			$this->UserStatus->UpdateStatus( $user_id, $lp, $atk, $rcr );
		}
	}
	
	public function update_quest_progress()
	{
		if( $this->request->input('json_decode') != null )
		{
			$json_data = $this->request->input('json_decode');
			$this->log( $json_data );
			$user_id = $json_data->user_id;
			$floor = $json_data->floor;
			$this->UserStatus->updateQuestProgress( $user_id, $floor );
			$results = 1;
			$this->set( 'results', $results );
			$this->viewClass = 'Json';
			$this->set( '_serialize', array( 'results' ) );
		}
		else
		{
			$results = 0;
			$this->set( 'results', $results );
			$this->viewClass = 'Json';
			$this->set( '_serialize', array( 'results' ) );
		}
	}
}
?>
