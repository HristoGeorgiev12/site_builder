<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 16.5.2016 �.
 * Time: 16:01 �.
 */

class Connect {
    public $connect;
    public $table;

    public function __construct($database) {
        try {
            $this->connect = new PDO('mysql:host=localhost;dbname='.$database.'; charset=utf8', 'root', '0000');
            // set the PDO error mode to exception
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    //Implode the insert method;
    public function implodeInsertedData($insertParams) {
        if(isset($insertParams)) {
            //Implode keys;
            $keyParam = implode(', ', array_keys($insertParams));

            //Implode values
            $valueConcatArray = array();
            foreach ($insertParams as $key => $value) {
                $valueConcatArray[] = " :" . $key;
            }
            $valueParam = implode(',', $valueConcatArray);

            $array = array($keyParam, $valueParam);
            return $array;
        }

    }
}