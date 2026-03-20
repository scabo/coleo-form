<?php

declare(strict_types=1);

namespace Coleo\Form;

use Exception;
use Coleo\Form\Checker\CheckerFactoryInterface;
use Coleo\Form\Checker\CheckerInterface;
use Coleo\Form\Filter\FilterFactoryInterface;
use Coleo\Form\Filter\FilterInterface;

/**
 * Html Form class
 */
class HtmlForm implements FormInterface
{
    private $rawData = [];
    private $data = [];
    private $errors = [];

    private ?string $currentField = null;

    /**
     * FormField[]
     */
    private $fields = [];

    /**
     * Construct
     *
     * @param FilterFactoryInterface $filterFactory
     * @param CheckerFactoryInterface $checkerFactory
     */
    public function __construct(
        private FilterFactoryInterface $filterFactory,
        private CheckerFactoryInterface $checkerFactory
    ) {
    }

    /**
     * @inheritDoc
     *
     * @param array $data
     * @return self
     */
    public function setRawData(array $data): self
    {
        $this->rawData = $data;
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param string|null $name
     * @return mixed
     */
    public function getData($name = null): mixed
    {
        if (empty($this->data) && !empty($this->rawData)) {
            throw new Exception("Data still not verifiled");
        }

        if (null !== $name) {
            return array_key_exists($name, $this->data) ? $this->data[$name] : null;
        }

        return $this->data;
    }

    /**
     * @inheritDoc
     *
     * @param string $fieldname
     * @return self
     */
    public function __invoke(string $fieldname): self
    {
        $this->currentField = $fieldname;
        $this->fields[$fieldname] = new FormField();
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param string $name
     * @param mixed ...$args
     * @return self
     */
    public function addFilterRule(string $name, ...$args): self
    {
        if ($this->currentField === null) {
            throw new Exception("Filtered field is not selected", 1);
        }

        if ($this->fields[$this->currentField]->filter === null) {
            $this->fields[$this->currentField]->filter = $this->filterFactory->create();
        }

        $this->fields[$this->currentField]->filter->addRule($name, ...$args);

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param string $name
     * @param string|null $customMessage
     * @param array $options
     * @return self
     */
    public function addCheckerRule(string $name, $customMessage = null, array $options = []): self
    {
        if ($this->currentField === null) {
            throw new Exception("Validated field is not selected", 1);
        }

        if ($this->fields[$this->currentField]->checker === null) {
            $this->fields[$this->currentField]->checker = $this->checkerFactory->create();
        }

        $this->fields[$this->currentField]->checker->addRule($name, ...$options);

        if ($customMessage) {
            $this->fields[$this->currentField]->checker->addErrorMessage($name, $customMessage);
        }

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @return boolean
     */
    public function verify(): bool
    {
        foreach ($this->rawData as $fieldName => $value) {
            if (array_key_exists($fieldName, $this->fields)) {
                $this->data[$fieldName] = ($this->fields[$fieldName]->filter instanceof FilterInterface)
                    ? $this->fields[$fieldName]->filter->clean($value)
                    : $value;

                if ($this->fields[$fieldName]->checker instanceof CheckerInterface) {
                    $err = $this->fields[$fieldName]->checker->check($this->getData($fieldName));
                    if (is_array($err) && !empty($err)) {
                        $this->errors[$fieldName] = $err;
                    }
                }
            }
        }

        return empty($this->errors) ? true : false;
    }

    /**
     * @inheritDoc
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
