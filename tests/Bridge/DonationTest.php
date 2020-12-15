<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Tests\Bridge;

use Orchestra\Testbench\TestCase;
use Inisiatif\Package\Template\Bridge\Donation;

final class DonationTest extends TestCase
{
    public function testCreateFromArray(): void
    {
        $date = new \DateTime();

        $donation = Donation::fromArray([
            'identification_number' => 2000002,
            'date' => $date,
            'amount' => 1000000,
            'branch_name' => 'DKI Jakarta',
        ]);

        $this->assertSame($donation->getIdentificationNumber(), 2000002);
        $this->assertSame($donation->getDate(), $date);
        $this->assertSame($donation->getAmount(), 1000000.0);
        $this->assertSame($donation->getAmountFormatted(), '1,000,000');
        $this->assertSame($donation->getBranchName(), 'DKI Jakarta');
    }
}
