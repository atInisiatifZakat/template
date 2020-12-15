<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Tests;

use Orchestra\Testbench\TestCase;
use Inisiatif\Package\Template\Rupiah;

final class RupiahTest extends TestCase
{
    /**
     * @var array
     */
    private $testNumbers = [
        'nol rupiah' => 0,
        'sepuluh rupiah' => 10,
        'tiga belas rupiah' => 13,
        'seratus tiga rupiah' => 103,
        'seribu tiga rupiah' => 1003,
        'seribu seratus tiga belas rupiah' => 1113,
        'dua ribu seratus tiga belas rupiah' => 2113,
        'tiga ribu seratus tiga belas rupiah' => 3113.12,
        'satu juta rupiah' => 1000000,
        'satu juta satu rupiah' => 1000001,
    ];

    public function testCanConvertStringRupiah(): void
    {
        foreach ($this->testNumbers as $expected => $number) {
            $this->assertSame($expected, Rupiah::str($number));
        }
    }

    public function testCanConvertTitleStringRupiah(): void
    {
        foreach ($this->testNumbers as $expected => $number) {
            $this->assertSame(mb_convert_case($expected, MB_CASE_TITLE, 'UTF-8'), Rupiah::titleCase($number));
        }
    }
}
