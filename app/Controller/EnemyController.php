<?php 
class EnemyController extends AppController
{
	public $uses = array( 'Enemy' );

	public function get_enemy()
	{
		if( $this->request->query[ 'floor' ] != null ) 
		{
			$floor = $this->request->query[ 'floor' ];
			$results = $this->Enemy->getEnemy( $floor );
			debug( $results );
			//$this->set( 'results', $results );
			//$this->viewClass = 'Json';
			//$this->set( '_serialize', array( 'results' ) );
		}	
	}
}
?>
