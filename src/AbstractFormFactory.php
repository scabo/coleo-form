<?php

declare(strict_types=1);

namespace Coleo\Form;

use Coleo\Form\Checker\CheckerFactoryInterface;
use Coleo\Form\Filter\FilterFactoryInterface;

/**
 * Abstract Form Factory class
 */
abstract class AbstractFormFactory implements FormFactoryInterface
{
    /**
     * Constructor
     *
     * @param FilterFactoryInterface $filterFactory
     * @param CheckerFactoryInterface $checkerFactory
     */
    public function __construct(
        protected FilterFactoryInterface $filterFactory,
        protected CheckerFactoryInterface $checkerFactory
    ) {
    }

    /**
     * @inheritDoc
     *
     * @return FormInterface
     */
    abstract public function create(): FormInterface;
}
