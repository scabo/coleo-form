<?php

namespace Coleo\Form\Filter;

/**
 * Filter factory interface
 */
interface FilterFactoryInterface
{
    /**
     * Create filter
     *
     * @return FilterInterface
     */
    public function create(): FilterInterface;

    /**
     * Syndax sugar for create() method
     *
     * @return FilterInterface
     */
    public function __invoke(): FilterInterface;
}
