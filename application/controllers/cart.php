<?php

class Cart extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$data['title']= 'Cart - OSC';
		$data['navigation']= 'Cart';
		$this->load->view('cart',$data, array('error' => ' ' ));
	}
	
	function update_cart(){
 		foreach($_POST['cart'] as $id => $cart)
		{			
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			
			$this->load->model('cart_model');
			$this->cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
		}
		
		redirect('cart');
	}	
	
	function remove($rowid) {
		
		$this->cart->update(array(
			'rowid' => $rowid,
			'qty' => 0
		));		
		redirect('cart');
		
	}	
	
	function destroy() {		
		$this->cart->destroy();
		redirect('cart');
	}	
	
	function add() // Adding product to cart
	{
		
		$this->load->model('cart_model');
		
		$product = $this->cart_model->getToCart($this->input->post('id'));
		
		$insert = array(
			'id' => $this->input->post('id'),
			'qty' => 1,
			'price' => $product->price,
			'name' => $product->name
		);
		if ($product->option_name) {
			$insert['options'] = array(
				$product->option_name => $product->option_values[$this->input->post($product->option_name)]
			);
		}
		
		$this->cart->insert($insert);
		
		redirect($this->input->post('redirect'));
		
		/*$t1 = md5(serialize($insert));
		$data=array();
		$data['oldtest']=$t1;
		
		$this->session->set_userdata($data);*/
		
	}	
	
	function show() {
		
		$cart = $this->cart->contents();
		
		echo "<pre>";
		print_r($cart);
	}
	
	function d() {
		
		$this->cart->destroy();
		echo "destroy() called";
	}	
	
}