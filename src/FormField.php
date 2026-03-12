<?php

namespace Coleo\Form;

use Coleo\Form\Checker\CheckerInterface;
use Coleo\Form\Filter\FilterInterface;

/**
 * Form Field class
 * 
 * It's contains checker and filter objects for working on with concrete form field
 */
final class FormField
{
    /**
     * Constructor
     *
     * @param CheckerInterface|null $checker field's checker
     * @param FilterInterface|null $filter field's filter
     */
    public function __construct(
        public ?CheckerInterface $checker = null,
        public ?FilterInterface $filter = null
    ) {
    }
}
