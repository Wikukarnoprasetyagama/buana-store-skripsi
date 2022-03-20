<?php

$targetFolder = __DIR__.'skripsiku/storage/app/public';
$linkFolder = __DIR__.'../storage';
symlink($targetFolder,$linkFolder);

echo 'Syimlink proccess successfully completed';