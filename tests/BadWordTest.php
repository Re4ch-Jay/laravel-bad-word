<?php

namespace Patoui\LaravelBadWord\Test;

class BadWordTest extends TestCase
{
    protected $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function it_validates_with_good_word()
    {
        $this->assertTrue($this->validator->make(
            ['words' => 'Hello world!'],
            ['words' => 'bad_word'])->passes()
        );
    }

    /** @test */
    public function it_validates_with_bad_word()
    {
        $this->assertFalse($this->validator->make(
            ['words' => 'Is there a badword here!'],
            ['words' => 'bad_word'])->passes()
        );
    }

    /** @test */
    public function it_validates_with_bad_word_english_only()
    {
        $this->assertTrue($this->validator->make(
            ['words' => 'Ç\'es-tu mauvais?'],
            ['words' => 'bad_word:en'])->passes()
        );
    }
}
