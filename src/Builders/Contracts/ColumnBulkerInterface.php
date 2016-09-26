<?php

namespace LucasRuroken\Backoffice\Builders\Contracts;

use Illuminate\Support\Collection;
use LucasRuroken\Backoffice\Builders\ColumnBulker;

interface ColumnBulkerInterface
{
    /**
     * @param string $columnName
     * @param void|string $callback
     * @return ColumnBulker
     */
    public function set($columnName, $callback);

    /**
     * @param string $columnName
     * @param Collection $row
     * @param string $default
     * @return string
     */
    public function bulk($columnName, Collection $row, $default);
}