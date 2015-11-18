<?php
use myClass\Foo;

//phpinfo();
require_once ("myTestVendor/autoload.php");
$foo = new Foo();
$validator = new Validator();
echo $foo->index();
echo '<br/>';
$validator->run($foo->index());

