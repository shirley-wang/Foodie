<?php
/**
 * Created by PhpStorm.
 * User: Guolei
 * Date: 2016/2/20
 * Time: 21:33
 */

require_once '../Medoo/medoo.php';

session_start();
//$_POST["Items"] = '[ { "category":"Chinese","description":"Hahahaha","price":10} , { "category":"Pizza","description":"LOLOLOLOI","price":15} ]';
//$_POST["Time"] = "2016-02-20 22:04:25";

if( isset( $_GET["Items"] ) && isset($_GET["Time"]) ){

    $database = new medoo([
        'database_type' => 'mysql',
        'database_name' => 'foodie',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '123456',
        'charset' => 'utf8'
    ]);

    $id = $database->insert("order",[
        'createdTime' => date("Y-m-d H:i:s"),
        'time' =>  $_GET["Time"],
        'location' => '2321 North Loop Drive，University Blvd，Ames, IA 50010'
    ]);

    $Items = json_decode($_GET["Items"], true);

    foreach($Items as $item){

        $database->insert("item",[
            'orderId' => $id,
            'category' => $item["category"],
            'description' =>  $item["description"],
            'price' => $item["price"]
        ]);
    }

    echo($id);


}else{
    echo("-1");
}



?>