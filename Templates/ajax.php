<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 25.5.2016 �.
 * Time: 20:35 �.
 */
session_start();
require_once "../Classes/Connect.class.php";
require_once "../Classes/Template.class.php";

function templateSpec($template_type) {
    $db = new Connect('site_builder');
    $query = "SELECT *
                    FROM templates WHERE template_type='$template_type'";
//        if($where) $query = $query . "WHERE template_type='$template_type'";
    $connection = $db->connect->prepare($query);
    $connection->execute();
    $result = $connection->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($result);
}

function selectAll($table) {
    $db = new Connect('site_builder');
    $query = "SELECT * FROM $table";
    $conn = $db->connect->prepare($query);
    $conn->execute();
    return $conn->fetchAll(PDO::FETCH_ASSOC);
}

function selectById($tableName, $id) {
    $db = new Connect('site_builder');
    $query = "SELECT * FROM $tableName WHERE id = $id";
    $conn = $db->connect->prepare($query);
//    TODO: BInd params error
//    $conn->bindParam(':tableName', $tableName, PDO::PARAM_STR);
//    $conn->bindParam(':id', $id, PDO::PARAM_INT);
    $conn->execute();
    return $conn->fetchAll(PDO::FETCH_ASSOC);
}

function createOrUpdateProjectTemplate($user_id,  $template_id, $json, $project_id = false) {
    $conn = new Connect('site_builder');
//TODO: throw exeptions in template_id or proect_id don`t exist
    if($project_id) {
        if($result = selectById('users_projects', $project_id)) {
            $json = json_decode($result[0]['json']);
            foreach ($json as $key=>$value) {
                $json-> $key= $value;
            }
//            $parseValues = json_encode($parseValues);
            $query = "UPDATE users_projects   
                       SET json = :json
                     WHERE id = :project_id ";
        }
    } elseif($template_id) {
        $query = "INSERT INTO users_projects(user_id, template_id, json ) VALUES (:user_id, :template_id, :json)";
    }


//TODO: check if there is such project_id
//    $query = "INSERT INTO users_projects(user_id, template_id, json ) VALUES (:user_id, :template_id, :json)";
//    if($project_id) {
//        $query = "UPDATE users_projects
//                       SET json = :json
//                     WHERE id = :project_id ";
//    }
    $db = $conn->connect->prepare($query);
    $db->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//    if($project_id == false) {
        $db->bindParam(':template_id', $template_id, PDO::PARAM_INT);
//    }else {
        $db->bindParam(':project_id', $project_id, PDO::PARAM_INT);
//    }
    $db->bindParam(':json', json_encode($json), PDO::PARAM_STR);


    $db->execute();

    return $conn->connect->lastInsertId();
}

if(isset($_POST['submitSearch'])) {
    echo searchData($_POST["valueSearch"]);
} elseif(isset($_POST['template_type'])) {
    echo templateSpec($_POST["template_type"]);
} elseif(isset($_POST['create'])) {
    echo createOrUpdateProjectTemplate(1, $_POST['template_id'], $_POST['params'],(int) $_POST['project_id']);
}