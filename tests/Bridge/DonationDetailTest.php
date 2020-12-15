<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Tests\Bridge;

use Orchestra\Testbench\TestCase;
use Inisiatif\Package\Template\Bridge\DonationDetail;

final class DonationDetailTest extends TestCase
{
    public function testCreateFromArray(): void
    {
        $detail1 = DonationDetail::fromArray([
            'funding_name' => 'Zakat Penghasilan',
            'amount' => 499999,
        ]);

        $this->assertSame($detail1->getAmount(), 499999.0);
        $this->assertSame($detail1->getAmountFormatted(), '499,999');
        $this->assertSame($detail1->getFundingName(), 'Zakat Penghasilan');
    }
}
