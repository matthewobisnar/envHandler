<?php
   require __DIR__ ."/vendor/autoload.php";

 $env = new \EnvHandler\Environment\Environment(__DIR__);

 $env->load(true);

?>