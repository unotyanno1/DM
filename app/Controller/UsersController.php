<?php 
class UsersController extends AppController
{
	public $uses = array( 'User', 'UserStatus', 'Level' );

	public function get_user()
	{
		if( $this->request->query[ 'user_id' ] != null  ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$results = $this->User->getUser( $user_id );
			debug( $results );
			//$this->set( 'results', $results );
			//$this->viewClass = 'Json';
			//$this->set( '_serialize', array( 'results' ) );
		}
	}
	public function add_user()
	{
		$results = $this->User->addUser();
		$this->UserStatus->addStatus( $results['user_id'] );
		//$results = $this->UserStatus->getStatus( $user_id );
		//$user_data = $this->User->getUser( $user_id );
		//$level_data = $this->Level->getLevelDesc( $results['UserStatus']['level'] );
		//$results['UserStatus']['level_description'] = $level_data['Level']['description'];
		//$results['UserStatus']['name'] = $user_data['User']['name'];
		//debug( $results );
		$this->set( 'results', $results );
		$this->viewClass = 'Json';
		$this->set( '_serialize', array( 'results' ) );
	}

	public function update_user_fb_id()
	{
		$this->log($this->request->input('json_decode'));
		if( $this->request->input('json_decode') != null ) 
		{
			$json_data = $this->request->input('json_decode');
			$user_id = $json_data->user_id;
			$fb_id = $json_data->fb_id;
			$chk_key = $json_data->chk_key;
			$this->User->updateUserFbId( $user_id, $fb_id, $chk_key );
			
			//成功したら1を返す
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
	
	public function get_friend_data()
	{
		if( $this->request->input('json_decode') != null ) 
		{
			$json_data = $this->request->input('json_decode');
			$this->log( $json_data );
			$fb_friend_id_list = $json_data->fb_friend_list;
			$this->log( $fb_friend_list );
			//$fb_friend_id_list = array( 100001002375020, 100002785140030, 100001963744175 );
			$friend_data = $this->User->getUserFbId( $fb_friend_id_list );
			//debug( $friend_data );
			foreach ( $friend_data as $i => $friend )
			{
				$friend_status_list[] = $this->UserStatus->getStatus( $friend['users']['user_id'] );
				//クエスト進捗の配列を生成
				$quest_progress_array[] = $friend_status_list[$i]['UserStatus']['quest_progress'];
			}
			//クエスト進捗で重複してる値を削除
			$quest_progress_array = array_unique( $quest_progress_array );
			//昇順にソート
			sort( $quest_progress_array );
			foreach ( $quest_progress_array as $m => $progress )
			{
				$progress_fb_id_list = array();
				foreach ( $friend_status_list as $friend_status )
				{
			        	if( $friend_status['UserStatus']['quest_progress'] == $progress ) 
					{
						$user_data = $this->User->getUser( $friend_status['UserStatus']['user_id'] );
						$progress_fb_id_list[] = $user_data['User']['fb_id'];
						$results[$m]['quest_progress'] = $progress;
						$results[$m]['fb_id'] = $progress_fb_id_list;
			        	}
				}
			}
			//debug( $results );
			$this->log( $results );

			$this->set( 'results', $results );
			$this->viewClass = 'Json';
			$this->set( '_serialize', array( 'results' ) );
		}
		else
		{
			$results = 0;
			$this->log( $results );
			$this->set( 'results', $results );
			$this->viewClass = 'Json';
			$this->set( '_serialize', array( 'results' ) );
		}
	}
}
?>
