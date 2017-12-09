<?php
include 'checkout.php';
class Shoppingcart {
	private $productLists;
	private $cartCheckout;

	public function __construct($productLists) {
		$this->productLists = $productLists;
		$this->cartCheckout = new Checkout($this->productLists);
	}

	public function addtoCheckout($productName) {
	    	
            $this->cartCheckout->add($productName);
            return True;
        }
        
	public function getTotalCost() {
		return $this->cartCheckout->getTotal();
	}

	
}
?>