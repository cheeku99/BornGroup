<?php
class Product {
	private $name;
	private $productPrice;
	private $bulkPriceArr;
        private $productstock;

	public function __construct($productName, $productPrice = 0.00, $bulkPriceArr = array()) {
		$this->name = $productName;
		$this->productPrice = $productPrice;
		$this->bulkPriceArr = $bulkPriceArr;
                
	}
	public function getUnitPrice() {
		return $this->productPrice;
	}

	public function setUnitPrice($price) {
		if ($price >= 0.00)
			$this->productPrice = $price;
	}
        
        
	public function getName() {
		return $this->name;
	}

	public function getbulkPriceArr() {
		return $this->bulkPriceArr;
	}

	public function setVolumePrice($number_of_items, $price) {
		if ($number_of_items > 1 && $price >= 0.00)
			$this->bulkPriceArr[$number_of_items] = $price;
	}

	public function removeVolumePrice($number_of_items) {
		unset($this->bulkPriceArr[$number_of_items]);
	}


        
        public function addProductToList() {
		$this->productstock[$productName] = new Product($productName, $productPrice, $vol_prices);
        }

	public function getProductFromList($productName) {
            return $this->productstock[$productName]; 
	}
        
        public function hasBulkPrices($productName) {

            //$product = $this->getProductFromInventory($productName);
            return !empty($this->getbulkPriceArr());
        }
}
?>