<?php

namespace CDshop;

use Exception;

class Product
{

    public function getProduct($productid)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT *
                                    FROM product
                                    WHERE productid = :productid");
        $statement->bindValue(":productid", $productid);
        $statement->execute();
        $res = $statement->fetch();
        return $res;
    }

    public function getProducts()
    {
        try {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * from product ORDER BY productid DESC");
            $stmt->execute();
            $products = $stmt->fetchAll();
            return $products;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function getProductBanners()
    {
        try {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * from product WHERE banner != '' ORDER BY productid DESC");
            $stmt->execute();
            $products = $stmt->fetchAll();
            return $products;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function searchProducts($query)
    {
        //todo
    }

    public function filterProducts($query)
    {
        //todo
    }

    public function orderProducts($query)
    {
        //todo
    }

    // filtering: https://stackoverflow.com/questions/33493048/ajax-filter-php-mysql-results-using-checkboxes-or-radio-button-on-same-page


}
