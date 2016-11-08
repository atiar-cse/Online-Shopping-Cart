<?php

class Cart_model extends CI_Model {
	
	function update_cart($rowid, $qty, $price, $amount) {
 		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount
		);

		$this->cart->update($data);
	}	
	
	function getToCart($id) {
		
		$results = $this->db->get_where('products', array('product_id' => $id))->result();
		$result = $results[0];
		
		if ($result->option_values) {
			$result->option_values = explode(',',$result->option_values);
		}
		
		return $result;
	}
	
}