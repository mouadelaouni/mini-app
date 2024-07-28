<?php
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testHome()
    {
        $_SERVER['REQUEST_URI'] = '/';
        ob_start();
        home();
        $output = ob_get_clean();
        $this->assertStringContainsString('Hello, World!', $output);
    }

    public function testError()
    {
        $_SERVER['REQUEST_URI'] = '/error';
        ob_start();
        error();
        $output = ob_get_clean();
        $this->assertStringContainsString('An error occurred', $output);
    }
}
