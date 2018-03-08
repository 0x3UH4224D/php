<?php
require './includes/Pages/Home.php';

use \CTG\Pages\Home;

$home = new Home();
echo $home->render();

?>
