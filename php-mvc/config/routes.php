<?php

use Src\Controller\DeleteVideoController;
use Src\Controller\EditVideoController;
use Src\Controller\NewVideoController;
use Src\Controller\VideoFormController;
use Src\Controller\VideoListController;

return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => NewVideoController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => EditVideoController::class,
    'GET|/remover-video' => DeleteVideoController::class,

];