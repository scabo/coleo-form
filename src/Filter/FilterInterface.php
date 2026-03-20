<?php

declare(strict_types=1);

namespace Coleo\Form\Filter;

/**
 * Filter interface
 */
interface FilterInterface
{
    /**
     * add rule to filter
     *
     * @param string $name
     * @param mixed ...$args
     * @return self
     */
    public function addRule(string $name, ...$args): self;

    /**
     * Cleaning the value with filter rules
     *
     * @param mixed $value
     * @return mixed filtered value
     */
    public function clean($value): mixed;
}
