<?php
namespace EnvHandler\Test;

class TestClass
{
    public function __construct()
    {
        var_dump(getenv('APP_NAME'));
    }
}