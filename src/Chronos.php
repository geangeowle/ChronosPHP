<?php

namespace Chronos;

use Chronos\Base\BaseObject;
use Chronos\Base\Dispatcher;

final class Chronos extends BaseObject
{
    const CAMELCASE = 1;
    const UNDERSCORE = 2;

    public function run()
    {
        $objDispatcher = new Dispatcher();
        $objDispatcher->dispatch();
    }
}
