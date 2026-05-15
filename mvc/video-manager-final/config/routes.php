<?php

use Src\Controller\DeleteVideoController;
use Src\Controller\EditVideoController;
use Src\Controller\JsonVideoListController;
use Src\Controller\LoginController;
use Src\Controller\LoginFormController;
use Src\Controller\LogoutController;
use Src\Controller\NewJsonVideoController;
use Src\Controller\NewVideoController;
use Src\Controller\VideoFormController;
use Src\Controller\VideoListController;

return [
    'GET|/' => VideoListController::class, //listagem de videos
    'GET|/novo-video' => VideoFormController::class, //tela de cadastro
    'POST|/novo-video' => NewVideoController::class, //salvar novo video
    'GET|/editar-video' => VideoFormController::class, //tela de edição
    'POST|/editar-video' => EditVideoController::class, //salvar edição
    'GET|/remover-video' => DeleteVideoController::class, //exclusão
    'GET|/login' => LoginFormController::class, //tela de login
    'POST|/login' => LoginController::class, //tela de login
    'GET|/logout' => LogoutController::class, //tela de logout
    'GET|/videos-json' => JsonVideoListController::class, //tela de logout
    'POST|/videos' => NewJsonVideoController::class, //tela de logout
];
