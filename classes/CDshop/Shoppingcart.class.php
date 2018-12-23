<?php

namespace CDshop;

use Exception;

class Shoppingcart
{

        public function addToShoppingcart($productid, $productname, $productprice, $productquantity){

            if(isset($_COOKIE["shopping_cart"]))
            {
                $cookie_data    = stripslashes($_COOKIE['shopping_cart']);
                $cart_data      = json_decode($cookie_data, true);
                //var_dump($cart_data) ;
            }
            else
            {
                $cart_data = array();
            }

            $item_id_list = array_column($cart_data, 'item_id');

            if(in_array($productid, $item_id_list))
            {
                foreach($cart_data as $keys => $values){
                    if($cart_data[$keys]["item_id"] == $productid){
                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $productquantity;
                    }
                }
            }
            else
            {
                $item_array = array(
                    'item_id'   => $productid,
                    'item_name'   => $productname,
                    'item_price'  => $productprice,
                    'item_quantity'  => $productquantity
                );
                $cart_data[] = $item_array;
            }


            $item_data = json_encode($cart_data);
            setcookie('shopping_cart', $item_data, time() + (86400 * 30), "/"); //30 days
        }



        public function deleteItem($productid)
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values){
                if($cart_data[$keys]['item_id'] == $productid){
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    setcookie("shopping_cart", $item_data, time() + (86400 * 30), "/");
                }
            }

        }


        public function clearShoppingcart()
        {
            setcookie("shopping_cart", "", time() - 3600, "/");
        }

}
