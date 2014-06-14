<?php
/**
 * Model_Mart
 *
 * Class that generates a model for the DB table "mart"
 *
 */
class Model_Mart extends Zend_Db_Table_Abstract
{
    /**
     * DataBase table name
     *
     * @var string
     */
    protected $_name = 'mart';

    /**
     * Retrieves all the $customerID Mart items with product details
     *
     * @param string $customerID
     *
     * @return array
     */
    public function getMart($customerID)
    {
        $where = 'mart.customerID = "' . $customerID . '"';
        $select = $this->select();
        $select->setIntegrityCheck(false)
            ->from($this->_name, array('mart.id','mart.customerID','mart.quantity', 'products.productID','products.name', 'products.price'))
            ->where($where)
            ->join(
                array('products' => 'products'),
                'products.productID = mart.productID', ''
        );
        return $this->fetchAll($select)->toArray();
    }

    /**
     * Retrieves the $customerID product item in his mart
     *
     * @param string $customerID
     * @param string $productID
     *
     * @return array
     */
    public function getProductMart($customerID, $productID)
    {
        $where = 'mart.customerID = "' . $customerID . '" AND mart.productID = ' . $productID;
        $select = $this->select();
        $select->where($where);
        $result = $this->fetchAll($select)->current();

        return $result;
    }

    /**
     * Insert a new product to the mart
     *
     * @param array $data
     *
     * @return integer
     * @throws Exception
     */
    public function addItem($data)
    {
        try {
            $returnValue = $this->insert($data);
        } catch (Zend_Db_Exception $e) {
            $returnValue = $e->getCode();
        }
        return $returnValue;
    }

    /**
     * Update the mart product
     *
     * @param array $data
     *
     * @return integer
     * @throws Exception
     */
    public function updateItem($data)
    {
        try {
            $where = 'id = '.$data['id'];
            $returnValue = $this->update($data, $where);
        } catch (Zend_Db_Exception $e) {
            $returnValue = $e->getCode();
        }
        return $returnValue;
    }

    /**
     * Remove a product from the mart
     *
     * @param $id
     * @internal param int $data
     *
     * @return integer
     */
    public function removeItem($id)
    {
        $where = 'id = '.$id;
        try {
            $returnValue = $this->delete($where);

        } catch(Zend_Db_Exception $e) {
            return $e;

        }
        return $returnValue;
    }

}