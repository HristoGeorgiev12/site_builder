<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 18.5.2016 г.
 * Time: 12:59 ч.
 */

class TPLcreatePost extends Template {

    private function insertPost($post_name, $user_id, $category_id) {
        $conn = $this->connection;

        $query = "INSERT INTO posts(post_name, user_id, category_id ) VALUES (?, ?, ?)";

        $db = $conn->connect->prepare($query);

        $db->bindParam(1, $post_name, PDO::PARAM_STR);
        $db->bindParam(2, $user_id, PDO::PARAM_INT);
        $db->bindParam(3, $category_id, PDO::PARAM_INT);

        $db->execute();

        $last_id = $conn->connect->lastInsertId();
        return $last_id;
    }


    public function Title() {
        return "Създаване на нова тема";
    }
    
    public function Body() {
        if(isset($_SESSION['user_id'])) {
            if(isset($this->aParams['submitPost'])) {
                $insert = $this->insertPost($this->aParams['postHeader'],$_SESSION['user_id'],$this->aParams['allCategories']);
                if($insert) header("Location:?page=comments&post=$insert");
            }



        ?>
            <form class="form-group" method="post">
                <input class="form-control" type="text" name="postHeader" placeholder="Заглавие на Темата" required>

                <select class="form-control" name="allCategories">
                    <option disabled selected>Селектирайте категория</option>
                    <?php

                        foreach($this->selectAll('categories') as $values) {
                            $catId = $values['id'];
                            $catName = $values['category_name'];

                            echo "<option value='{$catId}'>{$catName}</option>";
                        }
                    ?>
                </select><br>
                <input class="btn btn-default" type="submit" name="submitPost" value="Създай">
            </form>
        <?php
        }
    }
}