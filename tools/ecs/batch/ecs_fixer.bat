:: Run easy-coding-standard (ecs) via this batch file inside your IDE e.g. PhpStorm (Windows only)
:: Install inside PhpStorm the  "Batch Script Support" plugin
cd..
cd..
cd..
cd..
cd..
cd..
php vendor\bin\ecs check vendor/w3scout/contao-timetags-bundle/src --fix --config vendor/w3scout/contao-thermography-order/tools/ecs/config.php
php vendor\bin\ecs check vendor/w3scout/contao-timetags-bundle/contao --fix --config vendor/w3scout/contao-timetags-bundle/tools/ecs/config.php
php vendor\bin\ecs check vendor/w3scout/contao-timetags-bundle/config --fix --config vendor/w3scout/contao-timetags-bundle/tools/ecs/config.php
php vendor\bin\ecs check vendor/w3scout/contao-timetags-bundle/tests --fix --config vendor/w3scout/contao-thermography-order/tools/ecs/config.php
