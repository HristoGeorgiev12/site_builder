<?php

/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 18.5.2016 г.
 * Time: 17:38 ч.
 */
class TPLcomments extends Template
{

    private function postInformation($post_id)
    {
        $conn = $this->connection;

        $query = "SELECT
                        u.id AS creator_id,
                        post_name,
                        user_name,
                        date_created,
                        COUNT(c.id) AS commentsSum
                  FROM posts p
                  INNER JOIN users u
                  ON u.id=p.user_id
                  INNER JOIN  comments c
                  ON c.post_id = p.id
                  WHERE p.id=:post_id";


        $conn->execute();

        return $conn->fetchAll(PDO::FETCH_ASSOC);
    }

    private function showComments($post_id)
    {
        $conn = $this->connection;

        $query = "SELECT
                    u.id,
                    c.id AS comment_id,
                    user_name AS userName,
                    user_comment AS comment,
                    comment_date AS com_time
                  FROM comments c
                  INNER JOIN users u
                  ON u.id=c.user_id
                  WHERE c.post_id=:post_id
                  ORDER BY c.id DESC ";

        $conn = $conn->connect->prepare($query);
        $conn->bindParam(":post_id", $post_id, PDO::PARAM_INT);

        $conn->execute();

        return $conn->fetchAll(PDO::FETCH_ASSOC);
    }

    private function insertComment($user_id, $post_id, $comment)
    {
        $conn = $this->connection;

        $query = "INSERT INTO comments(user_id, post_id, user_comment) VALUES(?, ?, ?)";

        $conn = $conn->connect->prepare($query);

        $conn->bindParam(1, $user_id, PDO::PARAM_INT);
        $conn->bindParam(2, $post_id, PDO::PARAM_INT);
        $conn->bindParam(3, $comment, PDO::PARAM_STR);

        $conn->execute();
    }

    private function insertReply($user_id, $comment_id, $comment)
    {
        $conn = $this->connection;

        $query = "INSERT INTO replies(user_id, comment_id, comments) VALUES(?, ?, ?)";

        $conn = $conn->connect->prepare($query);

        $conn->bindParam(1, $user_id, PDO::PARAM_INT);
        $conn->bindParam(2, $comment_id, PDO::PARAM_INT);
        $conn->bindParam(3, $comment, PDO::PARAM_STR);


        $conn->execute();
    }

    private function showReplies($post_id)
    {
        $conn = $this->connection;
        $query = "SELECT
                    r.id,
                    r.comments,
                    r.comment_id,
                    r.reply_date,
                    u.user_name
                  FROM replies r

                  INNER JOIN comments c
                  ON c.id=r.comment_id

                  INNER JOIN posts p
                  ON c.post_id = p.id

                  INNER JOIN users u
                  ON u.id=r.user_id

                  WHERE p.id=:post_id";

        $conn = $conn->connect->prepare($query);
        $conn->bindParam(":post_id", $post_id, PDO::PARAM_INT);

        $conn->execute();

        return $conn->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Body()
    {


        if (isset($this->aParams['submit_reply'])) {
            $this->insertReply($_SESSION['user_id'], $this->aParams['comment_id'], $this->aParams['reply_comment']);
        } elseif (isset($this->aParams['insertComment'])) {
            $this->insertComment($_SESSION['user_id'], $this->aParams['post'], $this->aParams['comment']);
        }


        if (isset($this->aParams['post'])) {
            $aPostInformation = $this->postInformation($this->aParams['post'])[0];
            $aComments = $this->showComments($this->aParams['post']);
            $aReplies = $this->showReplies($this->aParams['post']);

            $postCreator = $aPostInformation['creator_id'];
        }

        ?>

        <button class="btn btn-default" id="writeComment">Напиши коментар</button>

        <form id="writeCommentForm" action="" method="post" style="display: none">
            <textarea class="form-control" name="comment"></textarea>
            <input class="btn btn-default" type="submit" name="insertComment" value="Изпрати">
        </form>

        <table class="table table-bordered">
            <thead>
            <tr class="success">
                <th colspan="2">
                    <?php
                    $postName = $aPostInformation['post_name'];
                    $createdBy = $aPostInformation['user_name'];
                    $createdDate = $aPostInformation['date_created'];
                    $commentsSum = $aPostInformation['commentsSum'];

                    echo "'<i>{$postName}</i>' -{$commentsSum} Коментара <br>";
                    echo "Тема на: {$createdBy}<br> Създадена на: {$createdDate}";
                    ?>
                </th>
            </tr>
            </thead>

            <tbody>

            <?php
            if (!empty($aComments[0]['comment'])) {
                $sortedValues = array();
                foreach ($aReplies as $replies) {

                    if (!isset($sortedValues[$replies['comment_id']])) {
                        $sortedValues[$replies['comment_id']] = array();
                    }
                    $sortedValues[$replies['comment_id']][] = $replies['comments'];
                }


                foreach ($aComments as $comments) {

                    $commenting_user_id = $comments['id'];
                    $comment_id = $comments['comment_id'];
                    $commentTime = $comments['com_time'];
                    $user = $comments['userName'];
                    $comment = $comments['comment'];

                    if ($postCreator == $commenting_user_id) {
                        echo "<tr class='success'>";
                    } else {
                        echo "<tr>";

                    }
                    echo " <td class='user_information'><b>{$user}</b><br>{$commentTime}</td>";

                    echo " <td id='{$comment_id}'>{$comment}<br><a class='reply_to_comment'>отговори</a>";

                    echo "<table>";

                    if (isset($sortedValues[$comment_id])) {
                        foreach ($aReplies as $value) {
                            $id = $value['comment_id'];
                            $reply = $value['comments'];
                            $userName = $value['user_name'];
                            $replyDate = $value['reply_date'];

                            if ($id == $comment_id) {

                                echo "<tr><th>{$userName} - {$replyDate}</th></tr><tr><td>{$reply}</td></tr>";
                            }

                        }

                    }
                    echo "</table>";


                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td>Няма писано по темата.</td></tr>";
            }

            ?>
            </tbody>
        </table>


        <?php
    }
}
