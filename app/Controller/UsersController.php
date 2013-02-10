<?php 
class UsersController extends AppController
{
	public $uses = array( 'User', 'UserStatus', 'Level' );

	public function get_user()
	{
		if( $this->request->query[ 'id' ] != null  ) 
		{
			$id = $this->request->query[ 'id' ];
			$results = $this->User->getUser( $id );
			debug( $results );
			//$this->set( 'results', $results );
			//$this->viewClass = 'Json';
			//$this->set( '_serialize', array( 'results' ) );
		}
	}
	public function add_user()
	{
		if( $this->request->query[ 'name' ] != null  ) 
		{
			$name = $this->request->query[ 'name' ];
			$user_id = $this->User->addUser( $name );
			$this->UserStatus->addStatus( $user_id );
			$results = $this->UserStatus->getStatus( $user_id );
			$user_data = $this->User->getUser( $user_id );
			$level_data = $this->Level->getLevelDesc( $results['UserStatus']['level'] );
			$results['UserStatus']['level_description'] = $level_data['Level']['description'];
			$results['UserStatus']['name'] = $user_data['User']['name'];
			debug( $results );
			//$this->set( 'results', $results );
			//$this->viewClass = 'Json';
			//$this->set( '_serialize', array( 'results' ) );
		}	
	}

}
?>
