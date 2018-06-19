<?php
use Zaichaopan\Flash\FlashServiceProvider;

abstract class TestCase extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [FlashServiceProvider::class];
    }
}
