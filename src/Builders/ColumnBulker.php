<?php

namespace LucasRuroken\LaraAdmin\Builders;

use Illuminate\Support\Collection;
use LucasRuroken\LaraAdmin\Builders\Contracts\ColumnBulkerInterface;

class ColumnBulker implements ColumnBulkerInterface
{
    /**
     * @type Collection
     */
    private $bulkedColumns;

    public function __construct()
    {
        $this->bulkedColumns = new Collection();
    }

    /**
     * @param string $columnName
     * @param void|string $callback
     * @return ColumnBulker
     */
    public function set($columnName, $callback)
    {
        $this->bulkedColumns->put($columnName, $callback);
        return $this;
    }

    /**
     * @param string $columnName
     * @param Collection $row
     * @param string $default
     * @return string
     */
    public function bulk($columnName, Collection $row, $default)
    {
        $call = $this->bulkedColumns->get($columnName, $default);

        if(is_callable($call))
        {
            return call_user_func($call, $row);
        }

        return $call;
    }
}