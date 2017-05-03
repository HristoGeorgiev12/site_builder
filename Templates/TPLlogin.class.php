<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 16.5.2016 г.
 * Time: 18:17 ч.
 */

class TPLlogin extends Template {
    private function loginCheck($user_name, $user_password) {
        $conn = $this->connection;
        $query = "SELECT * FROM users WHERE user_email=? AND user_password=?";
        $conn = $conn->connect->prepare($query);
        $conn->bindParam(1, $user_name, PDO::PARAM_STR);
        $conn->bindParam(2, md5($user_password), PDO::PARAM_STR);
        $conn->execute();
        return $conn->fetch();
    }

    public function Title() {
        return "Login";
    }

    public function Body() {

        if(isset($_SESSION['notLogged'])) {
            echo "Трябва да се впишите да да създавате теми или да коментирате постове";
            unset($_SESSION['notLogged']);
        }

        if(isset($this->aParams['loginSubmit'])) {
            $check = $this->loginCheck($this->aParams['userName'],$this->aParams['userPassword']);
            $lastUrl = "?".$_SESSION['lastPage'];


            if($check) {
                $_SESSION["userId"] = $check['id'];
                $_SESSION["UserName"] = $check['user_name'];
                header("Location: $lastUrl");
            } else {
                echo "Wrong inputed Username or password.";
            }
        }

        if(isset($this->aParams['logOut'])) {
            session_destroy();
            header("Location: ?page=index");
        }
        ?>
        <div class="container" >
            <div class="row">
                <div class="col-md-4">
                    <div class="well well-sm center">
                        <h4>Login</h4>
                        <form action="" method="post">

                            <input type="text"
                                   class="form-control"
                                   name="userName"
                                   placeholder="Name"
                                   required><br>

                            <input type="password"
                                   class="form-control"
                                   name="userPassword"
                                   placeholder="Password"
                                   required>

                            <a href="?page=index" class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
                            <!---->
                            <!--                            <input type="submit"-->
                            <!--                                   class="btn btn-primary pull-right"-->
                            <!--                                   name="submitRegistration"-->
                            <!--                                   value="Регистрирай ме!"-->
                            <!--                                   required>-->

<!--                            <button type="submit" class="btn btn-primary pull-right" name="loginSubmit"> Login <span class="glyphicon glyphicon-user"></span></button>-->
                            <input type="submit" class="btn btn-primary pull-right" name="loginSubmit" value="login">
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }
}