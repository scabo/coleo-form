<?php

namespace Coleo\Form;

/**
 * Undocumented interface
 */
interface FormBuilderInterface
{
    /**
     * Undocumented function
     *
     * @param array $data
     * @return FormInterface
     */
    public function build(array $data): FormInterface;
}
