<?php

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
