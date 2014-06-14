<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        setlocale(LC_MONETARY, 'de_DE');
        $this->_redirector = $this->_helper->getHelper('Redirector');

    }

    /**
     * Display the list of products
     */
    public function indexAction()
    {
        $modelProducts = new Model_Products();

        $result = $modelProducts->getProducts();
        $this->view->result = $result;

        $namespace = new Zend_Session_Namespace(); // default namespace
        if (!isset($namespace->customerID)) {
            $namespace->customerID = md5(uniqid(rand(), true));
        }

        $this->view->customerID = $namespace->customerID;
    }

    public function newAction()
    {
        // Disable render the custom view
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $namespace = new Zend_Session_Namespace(); // default namespace
        unset($namespace->customerID);

        $this->_redirector
            ->gotoUrl('/');
        return;
    }

    /**
     * Display the details of a product
     */
    public function detailsAction()
    {
        $productID = (int) $this->_request->getParam('productID');

        $modelProducts = new Model_Products();
        $result = $modelProducts->getProduct($productID, true);

        $this->view->result = $result;
    }

}

