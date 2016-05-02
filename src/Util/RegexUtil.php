<?php
namespace Aoa\Util;

/**
 * Class RegexUtil
 * @author viktorKhan
 * @link https://github.com/viktorKhan
 */
class RegexUtil
{
    /**
     * March an UUID with format 'aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee'
     */
    const MATCH_UUID = '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}';
}
