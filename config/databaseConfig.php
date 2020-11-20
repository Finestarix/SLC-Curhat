<?php

require_once(dirname(__FILE__) . '/../util/uriHelper.php');
checkURI(realpath(__FILE__));

return [
    /**
     * Database Server Host
     */
    'HOST' => 'localhost',

    /**
     * Database Server Port
     */
    'PORT' => 3306,

    /**
     * Database Username
     */
    'USERNAME' => 'root',

    /**
     * Database Password
     */
    'PASSWORD' => '',

    /**
     * Database Name
     */
    'DATABASE_NAME' => 'slc-curhat'
];


