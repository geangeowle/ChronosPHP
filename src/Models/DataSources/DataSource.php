<?php

namespace Chronos\Models\DataSources;

abstract class DataSource
{
    public function __construct()
    {
        if (!$this->enable()) {
            trigger_error($this->getDescription().' is not enable!');
        }

        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    abstract public function getDescription();

    abstract public function enable();

    abstract public function connect();

    abstract public function disconnect();

    abstract public function query($sql);
}