<?php

declare(strict_types=1);

namespace Coleo\Form;

/**
 * Html Form factory
 */
class HtmlFormFactory extends AbstractFormFactory
{
    /**
     * Create HtmlForm class
     *
     * @return FormInterface
     */
    public function create(): FormInterface
    {
        return new HtmlForm($this->filterFactory, $this->checkerFactory);
    }
}
