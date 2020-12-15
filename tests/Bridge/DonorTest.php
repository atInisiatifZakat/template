<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Tests\Bridge;

use Orchestra\Testbench\TestCase;
use Inisiatif\Package\Template\Bridge\Donor;

final class DonorTest extends TestCase
{
    public function testCreateFromArray(): void
    {
        $donor = Donor::fromArray([
            'identification_number' => 1000001,
            'name' => 'Foo Bar',
            'address' => 'Foo Bar Address',
            'tax_number' => 'Tax Number',
        ]);

        $this->assertSame($donor->getIdentificationNumber(), 1000001);
        $this->assertSame($donor->getName(), 'Foo Bar');
        $this->assertSame($donor->getAddress(), 'Foo Bar Address');
        $this->assertSame($donor->getTaxNumber(), 'Tax Number');
    }

    public function testCreateFromArrayWithAddressAndTaxNumberNull(): void
    {
        $donor = Donor::fromArray([
            'identification_number' => 1000001,
            'name' => 'Foo Bar',
        ]);

        $this->assertSame($donor->getIdentificationNumber(), 1000001);
        $this->assertSame($donor->getName(), 'Foo Bar');
        $this->assertNull($donor->getAddress());
        $this->assertNull($donor->getTaxNumber());
    }
}
