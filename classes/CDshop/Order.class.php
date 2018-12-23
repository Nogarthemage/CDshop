<?php

namespace CDshop;

use Exception;

class Order
{
    private $userid;
    private $shippingfirstname;
    private $shippinglastname;
    private $shippingaddress;
    private $paymenttype;


    public function getUserid()
    {
        return $this->userid;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    public function getShippingfirstname()
    {
        return $this->shippingfirstname;
    }


    public function setShippingfirstname($shippingfirstname)
    {
        $this->shippingfirstname = $shippingfirstname;

        return $this;
    }


    public function getShippinglastname()
    {
        return $this->shippinglastname;
    }


    public function setShippinglastname($shippinglastname)
    {
        $this->shippinglastname = $shippinglastname;

        return $this;
    }


    public function getShippingaddress()
    {
        return $this->shippingaddress;
    }

    public function setShippingaddress($shippingaddress)
    {
        $this->shippingaddress = $shippingaddress;

        return $this;
    }

    public function getPaymenttype()
    {
        return $this->paymenttype;
    }

    public function setPaymenttype($paymenttype)
    {
        $this->paymenttype = $paymenttype;

        return $this;
    }


    public function getOrders()
    {
        try {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * from orders ORDER BY orderid DESC");
            $stmt->execute();
            $orders = $stmt->fetchAll();
            return $orders;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }



    public function placeOrder()
    {
        try {

            $conn = Db::getInstance();

            $statement = $conn->prepare("INSERT INTO orders (orderdate, userid, shippingfirstname, shippinglastname, shippingaddress, paymenttype)
                                        VALUES (:orderdate, :userid, :shippingfirstname, :shippinglastname, :shippingaddress, :paymenttype)");
            $statement->bindValue(":orderdate", date("Y-m-d H:i"));
            $statement->bindValue(":userid", $this->getUserid());
            $statement->bindValue(":shippingfirstname", $this->getShippingfirstname());
            $statement->bindValue(":shippinglastname", $this->getShippinglastname());
            $statement->bindValue(":shippingaddress", $this->getShippingaddress());
            $statement->bindValue(":paymenttype", $this->getPaymenttype());

            if( $statement->execute() ){
                return $conn->lastInsertId();
            }else{
                return false;
            }


        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function updateOrder($orderid, $totalprice)
    {
        try {

            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE orders
                                        SET totalprice = :totalprice
                                        WHERE orderid = :orderid");
            $statement->bindValue(":orderid", $orderid);
            $statement->bindValue(":totalprice", $totalprice);

            return $statement->execute();

        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function addOrderDetail($orderid,$productid,$quantity)
    {
        try {

            $conn = Db::getInstance();

            $statement = $conn->prepare("INSERT INTO order_detail (orderid, productid, quantity)
                                        VALUES (:orderid, :productid, :quantity)");
            $statement->bindValue(":orderid", $orderid);
            $statement->bindValue(":productid", $productid);
            $statement->bindValue(":quantity", $quantity);

            return $statement->execute();

        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }





}
