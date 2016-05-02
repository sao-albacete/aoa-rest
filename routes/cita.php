<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 18/03/16
 * Time: 13:23
 */
use Aoa\Controller\CitaController;

/**
 * Version 1
 */
$app->get('/v1/citas[/{order}]', CitaController::class . ':getAll')->setName('citas-all');
$app->get('/v1/citas/{id}', CitaController::class . ':getById')->setName('cita-by-id');
