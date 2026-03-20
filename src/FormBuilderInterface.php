<?php

declare(strict_types=1);

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
