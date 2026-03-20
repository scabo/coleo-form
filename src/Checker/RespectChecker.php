<?php

declare(strict_types=1);

namespace Coleo\Form\Checker;

use Respect\Validation\Validator;

/**
 * Respect Checker class
 */
class RespectChecker implements CheckerInterface
{
    private array $rules = [];

    private array $errorMessages = [];

    /**
     * @inheritDoc
     *
     * @param string $name
     * @param mixed ...$options
     * @return self
     */
    public function addRule(string $name, ...$options): self
    {
        $className = "Respect\\Validation\\Rules\\" . ucfirst($name);

        if (class_exists($className)) {
            $this->rules[] = new $className(...$options);
        } else {
            throw new \Exception("Rule $name not found", 1);
        }

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param string $name
     * @param string $tpl
     * @return self
     */
    public function addErrorMessage(string $name, string $tpl): self
    {
        $this->errorMessages[$name] = $tpl;
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param mixed $value
     * @return bool|array
     */
    public function check($value): bool|array
    {
        try {
            $validator = new Validator(...$this->rules);
            // TODO there's default way for link custom error messages, use it
            $validator->assert($value);
        } catch (\Respect\Validation\Exceptions\NestedValidationException $e) {
            $result = $e->getMessages();
            foreach ($result as $name => $value) {
                if (array_key_exists($name, $this->errorMessages)) {
                    $result[$name] = $this->errorMessages[$name];
                }
            }
            return $result;
        }

        return true;
    }
}
