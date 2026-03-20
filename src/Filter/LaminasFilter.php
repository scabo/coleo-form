<?php

declare(strict_types=1);

namespace Coleo\Form\Filter;

/**
 * Laminas filter that is based on Laminas\Filter filtration libary
 */
class LaminasFilter implements FilterInterface
{
    /**
     * Undocumented variable
     *
     * @var iterable<\Laminas\Filter\FilterInterface>
     */
    private $rules = [];

    /**
     * @inheritDoc
     *
     * @param string $name
     * @param mixed ...$args
     * @return self
     */
    public function addRule(string $name, ...$args): self
    {
        $className = "Laminas\\Filter\\" . ucfirst($name);
        if (class_exists($className)) {
            $args = $args[0] ?? [];
            $this->rules[] = new $className($args);
        } else {
            throw new \Exception("Filter $className not found", 1);
        }

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @param mixed $value
     * @return mixed
     */
    public function clean($value): mixed
    {
        foreach ($this->rules as $rule) {
            $value = $rule->filter($value);
        }

        return $value;
    }
}
