<?php
class MaintenanceController extends AppController
{
	public function is_maintenance()
	{
		$results['Maintenance']['status'] = 'now_maintenance';
		$results['Maintenance']['message'] = '現在メンテナンス中です。ご迷惑をおかけしております。';
		$this->set( 'results', $results );
		$this->viewClass = 'Json';
		$this->set( '_serialize', array( 'results' ) );
	}

}
?>




