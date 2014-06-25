<?php

defined('KOOWA') or die('Protected resource');

$loader = KService::get('koowa:loader');

$loader->loadFile(JPATH_ROOT . '/config/com_multimedia/databases/tables/videos.php');