<?php

declare(strict_types=1);

namespace MyRoutine\Database;

use mysqli;
use mysqli_sql_exception;

class MySqlManager
{
    private ?mysqli $instance = null;

    /**
     * @return mysqli
     * @throws mysqli_sql_exception
     */
    public function connect(): mysqli
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->instance = new mysqli (HOSTNAME, USERNAME, PASSWORD, DATABASE, (int)PORT);
            $this->instance->set_charset(CHARSET);
        } catch (mysqli_sql_exception $e) {
            throw new mysqli_sql_exception('Ops! ' . $e->getMessage());
        }

        return $this->instance;
    }
}
