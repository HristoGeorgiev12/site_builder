<?php
/**
 * Created by PhpStorm.
 * User: Georgievi
 * Date: 16.5.2016 г.
 * Time: 15:58 ч.
 */

session_start();
ob_start();
require_once('Classes/Autoloader.class.php');
//$conn = new Connect('forum');

try {
    $page = "index";
    if(isset($_GET['page'])) $page = $_GET['page'];

    $loadClass = "TPL$page";

    if(!class_exists($loadClass)) $loadClass = "TPLerror";

    $template = new $loadClass();
    $template->setParams(array_merge($_GET, $_POST));
    $template->HTML();
}
catch(Exception $e) {
    var_dump($e);
}

$content = ob_get_contents();
ob_end_clean();

echo $content;