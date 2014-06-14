<?php

class MartController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        setlocale(LC_MONETARY, 'de_DE');
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    /**
     * Display the current guest customer mart
     */
    public function indexAction()
    {
        $namespace = new Zend_Session_Namespace(); // default namespace
        $customerID = $namespace->customerID;

        $modelMart = new Model_Mart();

        $result = $modelMart->getMart($customerID);
        $this->view->result = $result;
    }

    /**
     * Add a product to the current guest customer mart through an AJAX Request
     */
    public function addAction()
    {
        // Disable render the custom view
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $productID = (int) $this->_request->getParam('productID');
        $modelProducts = new Model_Products();
        $productDetails = $modelProducts->getProduct($productID, true);

        $namespace = new Zend_Session_Namespace(); // default namespace
        $customerID = $namespace->customerID;

        $modelMart = new Model_Mart();
        $productMart = $modelMart->getProductMart($customerID, $productID);
        if (null == $productMart) {
            /*
             * new product adition
             */
            $data = array(
                'customerID' => $customerID,
                'productID' => $productID,
                'quantity' => 1
            );
            $result = $modelMart->addItem($data);
        } else {
            /*
             * if the product exists at the mart, add the quantity
             */
            $quantity = $productMart->quantity + 1;
            $data = array(
                'id' => $productMart->id,
                'quantity' => $quantity
            );
            $result = $modelMart->updateItem($data);
        };

        // return message to the view
        if ($result) echo 'Product '.$productDetails['name'].' added' . (isset($quantity)?', '.$quantity.' times':'');
        else echo 'Product not added due to an error.';

    }

    /**
     * Remove a product from the current guest customer mart
     */
    public function deleteAction()
    {
        $martID = (int) $this->_request->getParam('martID');
        $modelMart = new Model_Mart();
        $result = $modelMart->removeItem($martID);

        $this->_redirector
            ->gotoUrl('/mart/index/');
        return;

    }

}

