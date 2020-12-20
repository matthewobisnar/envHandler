<?php
   require __DIR__ ."/vendor/autoload.php";

  (new \EnvHander\Environment\Environment(__DIR__))->load();

  var_dump(getenv('APP_NAME'));
?>