<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 14/03/16
 * Time: 12:23
 */
namespace Aoa\Core\Dotenv;

/**
 * Class EnvironmentVariables
 * @author Wonnova
 * @link http://www.wonnova.com
 */
class EnvironmentVariables
{
    /*
     * Database variables
     */
    const DB_HOST = 'DB_HOST';
    const DB_USER = 'DB_USER';
    const DB_PASSWORD = 'DB_PASSWORD';
    const DB_NAME = 'DB_NAME';
    const TABLE_PREFIX = 'TABLE_PREFIX';

    public static function getRequired()
    {
        return [self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME, self::TABLE_PREFIX];
    }
}
