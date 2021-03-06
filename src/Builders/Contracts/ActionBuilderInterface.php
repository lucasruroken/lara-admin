<?php

namespace LucasRuroken\LaraAdmin\Builders\Contracts;

use Illuminate\Support\Collection;
use LucasRuroken\LaraAdmin\Builders\Action;

interface ActionBuilderInterface
{
    /**
     * @return Action
     */
    public function build();

    /**
     * @return Collection
     */
    public function getActions();

    /**
     * @param Collection $model
     * @return string
     */
    public function render(Collection $model);

    /**
     * @return string
     */
    public function __toString();
}