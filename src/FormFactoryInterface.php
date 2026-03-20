<?php

declare(strict_types=1);

namespace Coleo\Form;

/**
 * Form factory interface
 */
interface FormFactoryInterface
{
    /**
     * Create Form instance
     *
     * @return FormInterface
     */
    public function create(): FormInterface;
}
