:: Run easy-coding-standard (ecs) via this batch file inside your IDE e.g. PhpStorm (Windows only)
:: Install inside PhpStorm the  "Batch Script Support" plugin
cd..
cd..
cd..
cd..
cd..
cd..
php vendor\bin\ecs check vendor/w3scout/contao-thermography-order/src --fix --config vendor/w3scout/contao-thermography-order/tools/ecs/config.php
php vendor\bin\ecs check vendor/w3scout/contao-thermography-order/contao --fix --config vendor/w3scout/contao-thermography-order/tools/ecs/config.php
php vendor\bin\ecs check vendor/w3scout/contao-thermography-order/config --fix --config vendor/w3scout/contao-thermography-order/tools/ecs/config.php
php vendor\bin\ecs check vendor/w3scout/contao-thermography-order/templates --fix --config vendor/w3scout/contao-thermography-order/tools/ecs/config.php
php vendor\bin\ecs check vendor/w3scout/contao-thermography-order/tests --fix --config vendor/w3scout/contao-thermography-order/tools/ecs/config.php
