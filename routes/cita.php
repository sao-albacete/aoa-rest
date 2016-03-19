<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 18/03/16
 * Time: 13:23
 */
use Aoa\Controller\CitaController;

$app->get('/citas', CitaController::class . ':getAll')->setName('citas-all');
