<?php
class Checkout {
	private $cart;
	private $productLists;

	public function __construct($productLists) {
		$this->cart = array();
                $this->productLists = $productLists;
	}

        public function add($productName) {
		if (isset($this->cart[$productName]))
			$this->cart[$productName]++;
		else
			$this->cart[$productName] = 1;
	}

	public function getTotal() {
		$total = 0;

		foreach ($this->cart as $productName => $productCount) {
			$total += $this->calculate($productName, $productCount);
		}

		return $total;
	}

	private function calculate($productName, $productCount) {
		$bulkPriceTotal = 0.00;
            	$left = $productCount;
        	if ($this->productLists[$productName]->hasBulkPrices($productName)) {
			$bulkPriceArr = $this->productLists[$productName]->getbulkPriceArr($productName);
			$bulkPriceCalculation = $this->calculateBulkPrice($productCount, $bulkPriceArr);

			$bulkPriceTotal = $bulkPriceCalculation[0];
			$left = $bulkPriceCalculation[1];
		}

		$productPrice = $this->productLists[$productName]->getUnitPrice($productName);
		$priceTotal = $this->calculateUnitPrice($left, $productPrice);
		
		return $bulkPriceTotal + $priceTotal;
	}

	private function calculateBulkPrice($productCount, $bulkPriceArr) {
		$bulkCount = array_keys($bulkPriceArr);

		$leastBulk = $this->findLeastBulk($productCount, $bulkCount);
		$total = 0.00;

		while ($leastBulk != -1 && $productCount != 0) {
			if ($leastBulk > $productCount) {
				$leastBulk = $this->findLeastBulk($productCount, $bulkCount);
			} else if (($productCount - $leastBulk) >= 0) {
				$productCount = $productCount - $leastBulk;
				$total += $bulkPriceArr[$leastBulk];
			}
		}

		return array($total, $productCount); 
	}	

	private function calculateUnitPrice($productCount, $productPrice) {
		return $productCount * $productPrice;
	}

	private function findLeastBulk($total, $bulkCount) {
		$smallest_diff = $total;
		$leastBulk = $bulkCount[0];
        	foreach($bulkCount as $bulk) {
			$diff = abs($total - $bulk);
            		if ($diff < $smallest_diff && $total >= $bulk) {
				$smallest_diff = $diff;
				$leastBulk = $bulk;
			}
		}
        	if ($leastBulk > $total) // not found
			return -1;
        	return $leastBulk;
	}
}
?>