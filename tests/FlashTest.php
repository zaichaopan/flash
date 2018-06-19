<?php

use Zaichaopan\Flash\Flash;

class FlashTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        unset(app()[Flash::class]);
    }

    /** @test */
    public function it_can_get_flash_instance_using_global_helper_flash()
    {
        $flash = flash();

        $this->assertInstanceOf(Flash::class, $flash);
    }

    /** @test */
    public function flash_class_instance_is_singleton()
    {
        $flash = flash();

        $anotherFlash = flash();

        $this->assertSame($flash, $anotherFlash);
    }

    /** @test */
    public function it_return_null_when_no_flash()
    {
        $flash = flash()->get();

        $this->assertNull($flash);
        $this->assertNull(flash()->message());
        $this->assertNull(flash()->type());
        $this->assertNull(flash()->options());
    }

    /** @test */
    public function it_can_get_correct_flash_data()
    {
        flash()->info($message = 'hello');
        $this->assertFlash('info', $message, []);

        flash()->info('hello', $options = ['foo' => 'bar', 'bar' => 'baz']);
        $this->assertFlash('info', 'hello', $options);

        flash()->success('hello');
        $this->assertFlash('success', 'hello', []);

        flash()->success('hello', $options = ['foo' => 'bar']);
        $this->assertFlash('success', 'hello', $options);

        flash()->warning('hello');
        $this->assertFlash('warning', 'hello', []);

        flash()->warning('hello', $options = ['foo' => 'bar']);
        $this->assertFlash('warning', 'hello', $options);

        flash()->error('hello');
        $this->assertFlash('error', 'hello', []);

        flash()->error('hello', $options = ['foo' => 'bar']);
        $this->assertFlash('error', 'hello', $options);

        flash()->danger('hello');
        $this->assertFlash('danger', 'hello', []);

        flash()->danger('hello', $options = ['foo' => 'bar']);
        $this->assertFlash('danger', 'hello', $options);
    }

    protected function assertFlash($type, $message, $options = [])
    {
        $this->assertEquals($type, $type = flash()->type());
        $this->assertEquals($message, flash()->message());
        $this->assertEquals($options, flash()->options());
        $this->assertEquals(compact('type', 'message', 'options'), flash()->get());
    }
}
