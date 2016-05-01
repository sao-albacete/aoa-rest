<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 9/03/16
 * Time: 23:48
 */

use Aoa\Controller\FamiliaController;

/**
 * Version 1
 */
$app->get('/v1/familias', FamiliaController::class . ':getAll')->setName('familias-all');
