<?php

return array(
    "host" => "localhost",
    "dbname" => "php2",
    "login" => "root",
    "password" => "root",
    "options" => array(
        "\PDO::ATTR_ERRMODE"           => '\PDO::ERRMODE_EXCEPTION',
        "\PDO::ATTR_DEFAULT_FETCH_MODE" => '\PDO::FETCH_ASSOC'		,
        "\PDO::ATTR_EMULATE_PREPARES" => "false"
    )
);
