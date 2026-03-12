<?php

namespace Coleo\Form\Filter;

/**
 * Laminas Filter class
 */
class LaminasFilterFactory implements FilterFactoryInterface
{
    /**
     * @inheritDoc
     *
     * @return FilterInterface
     */
    public function create(): FilterInterface
    {
        return new LaminasFilter();
    }

    /**
     * @inheritDoc
     *
     * @return FilterInterface
     */
    public function __invoke(): FilterInterface
    {
        return $this->create();
    }
}
