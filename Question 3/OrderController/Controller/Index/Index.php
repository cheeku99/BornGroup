<?php

namespace Born\OrderController\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action {

    public function execute() {

        $orderDetails = array();
	$orderid =
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('Magento\Sales\Model\Order')->load($orderid);
        $orderDetails['OrderNo'] = $order->getIncrementId();
        $orderDetails['OrderTotal'] = $order->formatPrice($order->getGrandTotal());
        $orderDetails['Status'] = $order->getStatusLabel();
        $items = $order->getAllItems();
        $orderItem = array();
        foreach ($items as $item) {
            $orderItem[]['itemId'] = $item->getItemId();
            $orderItem[]['Sku'] = $item->getSku();
            $orderItem[]['Price'] = $item->getPrice();
            $orderItem[]['qtyOrdered'] = $item->getQtyOrdered();
            $orderItem[]['qtyShipped'] = $item->getQtyShipped();
            $orderItem[]['qtyCanceled'] = $item->getQtyCanceled();
            $orderItem[]['qtyRefunded'] = $item->getQtyRefunded();
        }
        $orderDetails['ItemDetails'] = $orderItem;
        $invoice_id = array();
        foreach ($order->getInvoiceCollection() as $invoice) {
            $invoice_id[] = $invoice->getIncrementId();
        }
        if (!empty($invoice_id)) {
            $orderDetails['InvoiceNo'] = implode(",", $invoice_id);
        }
        return json_encode($orderDetails);
    }

}

