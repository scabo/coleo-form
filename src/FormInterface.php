<?php

namespace Coleo\Form;

/**
 * Form interface
 */
interface FormInterface
{
    /**
     * Set raw data
     *
     * @param array $form
     * @return self
     */
    public function setRawData(array $form): self;

    /**
     * Get filtered and checked data
     * 
     * If name is passed it returns one value by name, 
     * else it returns array with all data 
     *
     * @param string? $name
     * @return mixed
     */
    public function getData($name = null): mixed;

    /**
     * Initialize form field
     *
     * @param string $fieldname
     * @return self
     */
    public function __invoke(string $fieldname): self;

    /**
     * Add filter rule
     *
     * @param string $name filter name
     * @param mixed ...$args filter options
     * @return self
     */
    public function addFilterRule(string $name, ...$args): self;

    /**
     * Add checker rule
     *
     * @param string $name Checker rule
     * @param string|null $customMessage Custom error message
     * @param array $options checker options
     * @return self
     */
    public function addCheckerRule(string $name, $customMessage = null, array $options = []): self;

    /**
     * Verify form
     *
     * @return boolean
     */
    public function verify(): bool;

    /**
     * Get form errors
     *
     * @return array
     */
    public function getErrors(): array;
}
