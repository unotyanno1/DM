<?php
class FloorController extends AppController
{
	public $uses = array( 
		'GameNumberLogic',
		'GameNumberTimeLogic',
		'GameBombLogic',
		'GameBombTimeLogic',
		'GameHeartLogic',
		'GameHeartTimeLogic',
		'Enemy',
		'Background',
		'UserStatus',
		'User',
		'Level',
	);

	public function get_floor_data()
	{
		if( $this->request->query[ 'user_id' ] != null && $this->request->query[ 'floor' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$floor = $this->request->query[ 'floor' ];
			$heart_logic = $this->GameHeartLogic->getGameHeartLogic( $floor );
			$heart_time_logic = $this->GameHeartTimeLogic->getGameHeartTimeLogic( $floor );
			$bomb_logic = $this->GameBombLogic->getGameBombLogic( $floor );
			$bomb_time_logic = $this->GameBombTimeLogic->getGameBombTimeLogic( $floor );
			$enemy_data = $this->Enemy->getEnemy( $floor );
			$bg_data = $this->Background->getBackground( $floor );
			$user_status = $this->UserStatus->getStatus( $user_id );
			$user_data = $this->User->getUser( $user_id );
			$level_data = $this->Level->getLevelDesc( $user_status['UserStatus']['level'] );
			if( $heart_logic != null )
			{
				foreach ( $heart_logic as $i => $heart )
				{
			        	$heart_logic_data['GameHeartLogic'][$i] = $heart['GameHeartLogic'];
				}
				foreach ( $heart_time_logic as $i => $heart )
				{
			        	$heart_time_logic_data['GameHeartTimeLogic'][$i] = $heart['GameHeartTimeLogic'];
				}
				$results['GameHeartLogic'] = $heart_logic_data['GameHeartLogic'];
				$results['GameHeartTimeLogic'] = $heart_time_logic_data['GameHeartTimeLogic'];
			}
			if( $bomb_logic != null )
			{
				foreach ( $bomb_logic as $i => $bomb )
				{
			        	$bomb_logic_data['GameBombLogic'][$i] = $bomb['GameBombLogic'];
				}
				foreach ( $bomb_time_logic as $i => $bomb )
				{
			        	$bomb_time_logic_data['GameBombTimeLogic'][$i] = $bomb['GameBombTimeLogic'];
				}
				$results['GameBombLogic'] = $bomb_logic_data['GameBombLogic'];
				$results['GameBombTimeLogic'] = $bomb_time_logic_data['GameBombTimeLogic'];
			}

			$results['User'] = $user_data['User'];
			$results['UserStatus'] = $user_status['UserStatus'];
			$results['Level'] = $level_data['Level'];
			$results['Background'] = $bg_data['Background'];
			foreach ( $enemy_data as $enemy )
			{
				$results['Enemy'][] = $enemy['Enemy'];
			}
			$results['Level'] = $level_data['Level'];
			for( $i=0; $i < count($enemy_data); $i++ ) 
			{ 
				$number_logic = $this->GameNumberLogic->getGameNumberLogic( $floor , $i+1 );
				foreach ( $number_logic as $m => $number )
				{
					$number_logic_data['GameNumberLogic'][$m] = $number['GameNumberLogic'];
				}
				$results['GameNumberLogic'][] = $number_logic_data['GameNumberLogic'];
				if( $enemy_data[$i]['Enemy']['random'] == 1 ) 
				{
					$number_time_logic = $this->GameNumberTimeLogic->getGameNumberTimeLogic( $floor, $i+1 );
					foreach ( $number_time_logic as $k => $number )
					{
					$number_time_logic_data['GameNumberTimeLogic'][$k] = $number['GameNumberTimeLogic'];
					}
					$results['GameNumberTimeLogic'][] = $number_time_logic_data['GameNumberTimeLogic'];
				}
			}
			//debug( $results );
			$this->set( 'results', $results );
			$this->viewClass = 'Json';
			$this->set( '_serialize', array( 'results' ) );
		}
	}
}
?>
