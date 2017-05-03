<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 16.5.2016 ã.
 * Time: 16:35 ÷.
 */

class TPLerror extends Template {
    public function Title() {
        return "Error";
    }

    public function Body() {
        ?>
            <h1>Page not found</h1>
        <?php
    }
}