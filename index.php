<?php
use \app\core\App as appcoreapp; //OR on line 4: new app\core\App()
require('app/core/init.php');
new App(); //new appcoreapp(); -> works *Used when you have many namespaces

