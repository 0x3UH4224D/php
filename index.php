<?php
require_once './includes/Pages/Home.php';

use \CTG\Pages\Home;

$home = new Home();
echo $home->render();

?>
