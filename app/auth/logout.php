<?php

require_once dirname(dirname(__DIR__)).'/system.php';

logout();

redirect('./login.php');

?>