<?php 
class UserHasItemController extends AppController
{
	public $uses = array( 'UserHasItem', 'Item' );

	public function get_all_item()
	{
		if( $this->request->query[ 'user_id' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$results = $this->UserHasItem->getUserHasAllItem( $user_id );
			foreach ( $results as $i => $result )
			{
			        $item_data = $this->Item->getItem( $result['UserHasItem']['item_id'] );
				$results[$i]['Item'] = $item_data['Item'];
			}
			debug( $results );
		}	
	}

	public function add_item()
	{
		if( $this->request->query[ 'user_id' ] != null && $this->request->query[ 'item_id' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$item_id = $this->request->query[ 'item_id' ];
			$this->UserHasItem->addUserHasItem( $user_id, $item_id );
		}	
	}

	public function delete_item()
	{
		if( $this->request->query[ 'user_id' ] != null && $this->request->query[ 'item_id' ] != null ) 
		{
			$user_id = $this->request->query[ 'user_id' ];
			$item_id = $this->request->query[ 'item_id' ];
			$this->UserHasItem->deleteUserHasItem( $user_id, $item_id );
		}
	}
}
?>
