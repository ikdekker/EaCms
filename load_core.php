<?php

include "vendor/autoload.php";

use EaCms\EaCore;

define("ROOTPATH", __DIR__ . "/");

// load core module
$core = EaCore::getInstance();

$core->init();//$options);
$core->initThemes();
//$core->go();
