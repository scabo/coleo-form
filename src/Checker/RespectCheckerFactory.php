<?php

declare(strict_types=1);

namespace Coleo\Form\Checker;

/**
 * Factory class for creation the initial Respect checkers
 */
class RespectCheckerFactory implements CheckerFactoryInterface
{
    /**
     * @inheritDoc
     *
     * @return CheckerInterface
     */
    public function create(): CheckerInterface
    {
        return new RespectChecker();
    }

    /**
     * @inheritDoc
     *
     * @return CheckerInterface
     */
    public function __invoke(): CheckerInterface
    {
        return $this->create();
    }
}
