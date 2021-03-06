<?php

namespace LucasRuroken\LaraAdmin\Builders\Contracts;

use Illuminate\Support\Collection;
use LucasRuroken\LaraAdmin\Builders\ActionBuilder;
use LucasRuroken\LaraAdmin\Builders\ColumnBulker;

interface ListBuilderInterface
{
    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param array $columns
     */
    public function buildColumns(array $columns);

    /**
     * @return Collection
     */
    public function getColumns();

    /**
     * @param array $hiddenColumns
     */
    public function hideColumns(array $hiddenColumns);

    /**
     * @return Collection
     */
    public function getHiddenColumns();

    /**
     * @return Collection
     */
    public function visibleColumns();

    /**
     * @param array $columns
     */
    public function buildColumnTitles(array $columns);

    /**
     * @return Collection
     */
    public function getColumnTitles();

    /**
     * @param ActionBuilder $actionBuilder
     */
    public function setActionBuilder(ActionBuilder $actionBuilder);

    /**
     * @return ActionBuilder
     */
    public function getActionBuilder();

    /**
     * @param Collection $information
     */
    public function fillInformation(Collection $information);

    /**
     * @return Collection
     */
    public function getInformation();

    /**
     * @param ColumnBulker $columnBulkers
     */
    public function fillBulkers(ColumnBulker $columnBulkers);

    /**
     * @return ColumnBulker
     */
    public function getBulkers();

    /**
     * @return array
     */
    public function render();
}