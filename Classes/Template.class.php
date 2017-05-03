<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 16.5.2016 г.
 * Time: 16:01 ч.
 */

class Template {

    protected $connection;

    function __construct() {
        $this->connection = new Connect('site_builder');
    }

    //Merge Get and Post values into one array;
    public $aParams = array();
    public function setParams($parameters) {
        $this->aParams = $parameters;
    }

    public function getParams($key) {
        return isset($_GET[$key])? $this->aParams[$key]:"";
    }

    //Select method;
    public function selectWhere($dataBase,$table,$insertArray, $fetchAll=false) {
        $db = new Connect($dataBase,$table);

        $queryArray = array();
        foreach ($insertArray as $key => $value) {
            $queryArray[] = $key . "='{$value}'";
        }
        $queryArray = implode(' AND ', $queryArray);

        $connect = $db->connect->prepare("SELECT *
                                          FROM  $table
                                          WHERE $queryArray");

        $connect->execute();
        return !$fetchAll ? $connect->fetch() : $connect->fetchAll();
//        if(!$fetchAll)
//            return $connect->fetch();
//        else
//            return $connect->fetchAll();
    }

    protected function selectAll($table) {
        $conn = $this->connection;

        $query = "SELECT * FROM $table";

        $conn = $conn->connect->prepare($query);

        $conn->execute();

        return $conn->fetchAll();
    }

    protected function selectById($tableName, $id) {
        $conn = $this->connection;

        $query = "SELECT * FROM :tableName WHERE id = :id";

        $conn = $conn->connect->prepare($query);

        $conn->bindParam(':tableName', $tableName, PDO::PARAM_STR);
        $conn->bindParam(':id', $id, PDO::PARAM_INT);

        $conn->execute();

        return $conn->fetchAll();
    }


    //Insert data in the corresponding database and table;
    public function insert($dataBase, $table, $insertArray) {
        $db = new Connect($dataBase,$table);

        $connectInsert = $db->implodeInsertedData($insertArray);
        $keyParam = $connectInsert[0];
        $valueParam = $connectInsert[1];

        $connect = $db->connect->prepare("INSERT INTO
                                          $table" ." (".$keyParam.")
										  VALUES(".$valueParam.")");
        $connect->execute($insertArray);
        return  $db->connect->lastInsertId();
    }



    public function Title() {
        return "Test";
    }

    public function Body() {
        ?>
            <h1>Test Forum</h1>
        <?php
    }

    public function HTML() {

        ?>
            <html>
                <head>
<!--                    Meta-->
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

                    <title>
                        <?php
                            if(isset($this->aParams["page"])) {
                                echo $this->aParams["page"];
                            }else {
                                echo $this->Title();
                            }
                        ?>
                    </title>

<!--                    StylesSheets-->
                    <link rel="stylesheet" type="text/css" href="style/style.css">
<!--                    <link rel="stylesheet" type="text/css" href="style/bootstrap.css">-->
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                    <link rel="stylesheet" type="text/css" href="style/w3.css">

<!--                    JS Scripts-->
                    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
                    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
                </head>
                <body>
                <div class="container">
                    <h4><?php
                           echo isset($_SESSION['user_name'])?"Здравей, ". $_SESSION['user_name']:null;
                        ?></h4><br>



                    <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="?page=index">Main</a></li>
                                <li class="active"><a href="?page=create">Create</a></li>
<!--                                <li class="dropdown">-->
<!--                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Create-->
<!--                                        <span class="caret"></span></a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li><a href="?page=create&template=Site">Create Site</a></li>-->
<!--                                        <li><a href="?page=create&template=Blog">Create Blog</a></li>-->
<!--                                        <!--                                        <li><a href="#">Page 1-3</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li class="active"><a href="?page=index">View Projects</a></li>-->
<!--                                <li class="dropdown">-->
<!--                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">View-->
<!--                                        <span class="caret"></span></a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li><a href="#">Sites</a></li>-->
<!--                                        <li><a href="#">Blogs</a></li>-->
<!--<!--                                        <li><a href="#">Page 1-3</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
                            </ul>
<!--                            <form class="navbar-form navbar-left">-->
<!--                                <div class="input-group">-->
<!--                                    <input type="text" class="form-control" placeholder="Search">-->
<!--                                    <div class="input-group-btn">-->
<!--                                        <button class="btn btn-default" type="submit">-->
<!--                                            <i class="glyphicon glyphicon-search"></i>-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </form>-->
                            <ul class="nav navbar-nav navbar-right">
                                <?php
                                    if(isset($_SESSION["user_id"])) {
                                        echo '<li><a href="?page=login&logOut=true">Излизане</a></li>';
                                    }else {
                                        echo "<li class=\"right\" >
                                                    <a href=\"?page=registration\">
                                                        <span class=\"glyphicon glyphicon-user\"></span> Sign Up
                                                     </a>
                                              </li>
                                                <li>
                                                    <a href=\"?page=login\">
                                                        <span class=\"glyphicon glyphicon-log-in\"></span> Login
                                                     </a>
                                                 </li>";
                                    }
                                ?>

                            </ul>
                        </div>
                    </nav>
                        <?= $this->Body();?>

                </div><!--End of container-->

                <script>
                    var logged = <?= isset($_SESSION['user_id'])?$_SESSION['user_id']: 0; ?> ;

                    $("#writeComment").on("click", function() {
                        if(!logged) {
                            var promptResult = confirm("Не може да коментирате без да сте вписани! Жлаете ли да се впишете?");
                            if(promptResult == true) {
                                window.location.replace("?page=login");
                            }
                        }else {
                            $("#writeCommentForm").toggle("slow");
                        }
                    });

                    $("#createNewPost").on("click", function() {
                        if(!logged) {
                            var promptResult = confirm("Не може да коментирате без да сте вписани! Жлаете ли да се впишете?");
                            if(promptResult == true) {
                                window.location.replace("?page=login");
                            }else {
                                false;
                            }
                        }else {
                            window.location.replace("?page=createPost");
                        }
                    });

                    $(".reply_to_comment").one("click", function() {
                        var comment_id = $(this).parent().attr('id');
                        var current_url = '<?= $_SERVER['QUERY_STRING'];?>';

                        $(this).parent().append("<form action='?"+current_url+"' method='post'><input type='hidden' name='comment_id' value='"+comment_id+"'><textarea name='reply_comment'></textarea><input type='submit' name='submit_reply' value='Отговори'> </form>");
                    });



                </script>

                <?php
                    if($this->aParams['page'] !== 'login') $_SESSION['lastPage'] = $_SERVER['QUERY_STRING'];
                ?>

                </body>
            </html>
        <?php
    }
}