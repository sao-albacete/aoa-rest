<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 14/03/16
 * Time: 10:43
 */

// The base path source of log files
$basePath   = __DIR__ . '/../logs/';

return [
    'logger' => [
        'appenders' => [
            'appFileAppender' => [
                'class'        => LoggerAppenderFile::class,
                'threshold'    => LoggerLevel::DEBUG,
                'layout'       => [
                    'class' => LoggerLayoutPattern::class,
                    'params' => [
                        'conversionPattern' => '%date [%pid] From:%server{REMOTE_ADDR}:%server{REMOTE_PORT} Request:[%request] Message: %msg%n',
                    ]
                ],
                'params' => [
                    'file'     => $basePath . '/app.log',
                    'append'   => 'true',
                ],
            ],
        ],

        'rootLogger' => [
            'level'        => LoggerLevel::DEBUG,
            'appenders'    => [
                'appFileAppender',
            ],
        ],
    ]
];
