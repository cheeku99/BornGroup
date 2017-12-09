
<?php

include 'shoppingcart.php';
include 'product.php';
$productLists['A'] = new Product("A", 2.00, array(4 => '7.00'));
$productLists['B'] = new Product("B", 12.00);
$productLists['C'] = new Product("C", 1.25, array(6 => 6.00));
$productLists['D'] = new Product("D", 0.15);

$shoppingCart = new Shoppingcart($productLists);
$productList = "ABCDABAA";

for ($i = 0; $i < strlen($productList); $i++) {

    if ($productList[$i] != " ")
        $shoppingCart->addtoCheckout($productList[$i]);
}
echo $shoppingCart->getTotalCost();
?>

