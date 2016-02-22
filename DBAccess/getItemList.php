<?php
/**
 * Created by PhpStorm.
 * User: Guolei
 * Date: 2016/2/20
 * Time: 17:46
 */

require_once '../Medoo/medoo.php';


    $database = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'foodie',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8'
    ]);

    $datas = $database->select("item","*");

    echo( "[ " );

    $count = 0;

    foreach($datas as $data){
        if( $count == 0){
            echo( " {" );
        }
        else{
            echo( " , {" );
        }

        $count++;

        echo( ' "itemId":'. $data["itemId"] . ',' );
        echo( '"orderId":'. $data["orderId"] . ',' );
        echo( '"category":"'. $data["category"] . '",' );
        echo( '"description":"'. $data["description"] . '",' );
        echo( '"price":'. $data["price"]  );
        echo( "}" );
    }

    echo( " ]" );

?>