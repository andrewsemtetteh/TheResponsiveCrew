<?php
require 'config/constants.php';

//destroy all sessions and redirect them to the home page

session_destroy();

header('Location:' . ROOT_URL);
die();
?>