<?php
/**
 * Model_Products
 *
 * Class that generates a model for the DB table "products"
 *
 */
class Model_Products extends Zend_Db_Table_Abstract
{
    /**
     * DataBase table name
     *
     * @var string
     */
    protected $_name = 'products';

    /**
     * Retrieves all the posts as Array
     *
     * @return array
     */
    public function getProducts()
    {
        $orderby = array('productCode DESC');
        $result = $this->fetchAll('1', $orderby );
        return $result->toArray();
    }

    /**
     * Retrieves one product as Array
     *
     * @param integer $id
     * @param boolean $toArray
     *
     * @return array|null|\Zend_Db_Table_Row_Abstract
     * @throws Exception
     */
    public static function getProduct($id)
    {
        $oProduct = new self();
        $id = (int)$id;
        $row = $oProduct->fetchRow('productID = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }

        return $row->toArray();


    }

}