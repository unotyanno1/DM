<?php 
class EnemyController extends AppController
{
	public $uses = array( 'Enemy', 'Background' );

	public function get_enemy()
	{
		if( $this->request->query[ 'floor' ] != null ) 
		{
			$floor = $this->request->query[ 'floor' ];
			$results = $this->Enemy->getEnemy( $floor );
			$bg_data = $this->Background->getBackground( $floor );
			$results['Enemy']['bg_img_id'] = $bg_data['Background']['img_id'];
			debug( $results );
			//$this->set( 'results', $results );
			//$this->viewClass = 'Json';
			//$this->set( '_serialize', array( 'results' ) );
		}	
	}
}
?>
