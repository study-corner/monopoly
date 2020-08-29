<?php

namespace App\Tests\Controller;

use App\Controller\IndexController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;

class IndexControllerTest extends TestCase
{
    public function testIndexController(): void
    {
        $controller = new IndexController();
        $controller->setContainer(new Container());
        $response = $controller->index();
        $this->assertInstanceOf(Response::class, $response);
    }
}
