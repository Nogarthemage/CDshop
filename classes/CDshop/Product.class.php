<?php

namespace CDshop;

use Exception;

class Product
{

    private $artist;
    private $name;
    private $description;
    private $cover;
    private $banner;
    private $genre;
    private $type;
    private $releasedate;
    private $price;


    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    public function getBanner()
    {
        return $this->banner;
    }

    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }


    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }


    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getReleasedate()
    {
        return $this->releasedate;
    }

    public function setReleasedate($releasedate)
    {
        $this->releasedate = $releasedate;

        return $this;
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }



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

    public function deleteProduct($productid)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("DELETE FROM product WHERE productid=:id");
        $statement->bindValue(':id', $productid);
        return $statement->execute();
    }

    public function addProduct()
    {
        try {

            $conn = Db::getInstance();

            $statement = $conn->prepare("INSERT INTO product (artist, name, description, cover, banner, genre, type, releasedate, price)
                                        VALUES (:artist, :name, :description, :cover, :banner, :genre, :type, :releasedate, :price)");
            $statement->bindValue(":artist", $this->getArtist());
            $statement->bindValue(":name", $this->getName());
            $statement->bindValue(":description", $this->getDescription());
            $statement->bindValue(":cover", $this->getCover());
            $statement->bindValue(":banner", $this->getBanner());
            $statement->bindValue(":genre", $this->getGenre());
            $statement->bindValue(":type", $this->getType());
            $statement->bindValue(":releasedate", $this->getReleasedate());
            $statement->bindValue(":price", $this->getPrice());

            return $statement->execute();

        } catch (Exception $e) {
            $error = $e->getMessage();
            echo  $error;
            return $error;
        }
    }



    public function updateProductByID($productid)
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE product
                                        SET artist = :artist, name = :name, description = :description, cover = :cover, banner = :banner, genre = :genre, type = :type, releasedate = :releasedate, price = :price
                                        WHERE productid = :id");
            $statement->bindValue(":artist", $this->getArtist());
            $statement->bindValue(":name", $this->getName());
            $statement->bindValue(":description", $this->getDescription());
            $statement->bindValue(":cover", $this->getCover());
            $statement->bindValue(":banner", $this->getBanner());
            $statement->bindValue(":genre", $this->getGenre());
            $statement->bindValue(":type", $this->getType());
            $statement->bindValue(":releasedate", $this->getReleasedate());
            $statement->bindValue(":price", $this->getPrice());
            $statement->bindValue(":id", $productid);

            return $statement->execute();
        } catch (Exception $e) {
             $error = $e->getMessage();
             echo  $error;
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
