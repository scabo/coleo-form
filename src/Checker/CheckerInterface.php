<?php

namespace Coleo\Form\Checker;

/**
 * Checker interface
 */
interface CheckerInterface
{
    /**
     * Add checking rule
     *
     * @param string $name  Name of checking rule
     * @param mixed ...$options
     * @return self
     */
    public function addRule(string $name, ...$options): self;

    /**
     * Add error message template for checking rule. 
     *
     * @param string $name Name of checking rule
     * @param string $tpl Error template
     * @return self
     */
    public function addErrorMessage(string $name, string $tpl): self;

    /**
     * Check a value using chain of rules
     * 
     * It returns TRUE if value is valid or 
     * if it is not valid - error messages array
     * 
     * @param mixed $value
     * @return bool|array
     */
    public function check($value): bool|array;
}
