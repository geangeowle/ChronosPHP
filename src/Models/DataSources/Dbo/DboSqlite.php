<?php

namespace Chronos\Models\DataSources\Dbo;

use Chronos\Models\DataSources\DataSource;

class DboSqlite extends DataSource
{
    public $conn;
    private $description = 'Driver DboSqlite';
    private $extension = 'sqlite3';

    public function getDescription()
    {
        return sprintf('[%s] %s', $this->extension, $this->description);
    }

    public function enable()
    {
        return extension_loaded($this->extension);
    }

    public function connect()
    {
        //$dbhandle = sqlite_open('db/test.db', 0666, $error);
        //try {
        $this->conn = new \SQLite3('/var/www/html/public/test');
        // } catch (Exception $e) {
        //     die($e->getMessage());
        // }
    }

    public function disconnect()
    {
        $this->conn->close();
    }

    public function query($sql)
    {
        $result = $this->conn->query($sql);
        $return = [];

        // change this
        if (false !== $result) {
            while ($row = $result->fetchArray()) {
                foreach ($row as $k => $data) {
                    if (is_int($k)) {
                        unset($row[$k]);
                    }
                }
                $return[] = $row;
            }
        } else {
            pr($this->conn->lastErrorMsg());
            die("Error in query: <span style='color:red;'>$sql</span>");
        }

        return $return;
    }
}