<?php
namespace Kildsforkids\ExampleClientBundle;

use Kildsforkids\ExampleClientBundle\DependencyInjection\ExampleClientExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExampleClientBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ExampleClientExtension();
    }
}