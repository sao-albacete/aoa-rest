<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 9/03/16
 * Time: 23:48
 */

use Aoa\Controller\FamiliaController;

$app->get('/familias', FamiliaController::class . ':getAll')->setName('familias-all');

