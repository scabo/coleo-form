<?php

declare(strict_types=1);

namespace Coleo\Form\Checker;

/**
 * Checker Factory Interface
 */
interface CheckerFactoryInterface
{
    /**
     * Create instance of Checker
     *
     * @return CheckerInterface
     */
    public function create(): CheckerInterface;

    /**
     * Syntax sugar for create() method
     *
     * @return CheckerInterface
     */
    public function __invoke(): CheckerInterface;
}
