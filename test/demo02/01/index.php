<?php
require './Smarty.class.php';
$smarty = new Smarty();
$smarty->assign('title', 'fuck日你先人');
$smarty->compile('./index.html');