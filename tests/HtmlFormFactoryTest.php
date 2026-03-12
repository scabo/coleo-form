<?php

namespace ColeoTest\Form;

use Coleo\Form\Checker\RespectCheckerFactory;
use Coleo\Form\Filter\LaminasFilterFactory;
use Coleo\Form\HtmlForm;
use Coleo\Form\HtmlFormFactory;
use PHPUnit\Framework\TestCase;

/**
 * HtmlformFactoryTest
 * @group
 */
class HtmlformFactoryTest extends TestCase
{
    public function testCreate()
    {
        $htmlFormFactory = new HtmlFormFactory(new LaminasFilterFactory, new RespectCheckerFactory);
        $htmlForm = $htmlFormFactory->create();
        $this->assertInstanceOf(HtmlForm::class, $htmlForm);
    }
}