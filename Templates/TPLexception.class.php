<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 7.6.2016 г.
 * Time: 11:45 ч.
 */

class TPLexception extends Template{

    public function Title() {
        return "exceptionaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
    }

    public function Body() {

        function inverse($x) {
            if (!$x) {
                throw new Exception('Division by zero.');
            }
            return 1/$x;
        }

        try {
            echo inverse(5) . "\n";
            echo inverse(0) . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

// Continue execution
        echo "Hello World\n";


        ?>
            <h2>aonsodnas</h2>
        <?php
    }
}