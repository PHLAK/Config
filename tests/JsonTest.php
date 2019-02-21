<?php

namespace PHLAK\Config\Tests;

use PHLAK\Config\Config;
use PHLAK\Config\Tests\Traits\Initializable;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    use Initializable;

    protected function setUp(): void
    {
        $this->validConfig = __DIR__ . '/files/json/config.json';
        $this->invalidConfig = __DIR__ . '/files/json/invalid.json';
    }
}
