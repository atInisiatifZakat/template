<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Tests;

use Illuminate\View\Factory;
use Orchestra\Testbench\TestCase;
use Inisiatif\Package\Template\Rupiah;
use Inisiatif\Package\Template\Bridge\Donor;
use Inisiatif\Package\Template\Bridge\Donation;
use Inisiatif\Package\Template\Bridge\DonationDetail;
use Inisiatif\Package\Template\InisiatifTemplateServiceProvider;

final class BszViewTest extends TestCase
{
    public function testCanRenderBszView(): void
    {
        $donor = Donor::fromArray([
            'identification_number' => '1000001',
            'name' => 'Foo Bar',
            'address' => 'Foo Bar Address',
            'tax_number' => 'Tax Number',
        ]);

        $donation = Donation::fromArray([
            'identification_number' => '2000002',
            'date' => new \DateTime(),
            'amount' => 1000000,
            'branch_name' => 'DKI Jakarta',
        ]);

        $details = [
            $detail1 = DonationDetail::fromArray([
                'funding_name' => 'Zakat Penghasilan',
                'amount' => 499999,
            ]),
            $detail2 = DonationDetail::fromArray([
                'funding_name' => 'Zakat Investasi',
                'amount' => 500001,
            ]),
        ];

        /** @var Factory $view */
        $view = $this->app->make('view');

        $render = $view->make('inisiatif::prints.bsz', compact('donor', 'donation', 'details'))->render();

        $this->assertStringContainsString($detail1->getFundingName(), $render);
        $this->assertStringContainsString($detail1->getAmountFormatted(), $render);
        $this->assertStringContainsString($detail2->getFundingName(), $render);
        $this->assertStringContainsString($detail2->getAmountFormatted(), $render);
        $this->assertStringContainsString($donation->getAmountFormatted(), $render);

        /** @var string $nominal */
        $nominal = Rupiah::titleCase($donation->getAmount());
        $this->assertStringContainsString($nominal, $render);

        $date = $donation->getDate()->format('d - m - Y');
        $this->assertStringContainsString($date, $render);

        $branchName = mb_convert_case($donation->getBranchName(), MB_CASE_TITLE, 'UTF-8');
        $this->assertStringContainsString($branchName, $render);

        $identificationNumber = (string) $donation->getIdentificationNumber();
        $this->assertStringContainsString($identificationNumber, $render);

        $number = 'IZI/BSZ/' . $donation->getDate()->format('Y') . '/' . $donation->getIdentificationNumber();
        $this->assertStringContainsString($number, $render);

        $name = $donor->getName();
        $this->assertStringContainsString($name, $render);

        $identificationNumber = (string) $donor->getIdentificationNumber();
        $this->assertStringContainsString($identificationNumber, $render);

        /** @var string $address */
        $address = $donor->getAddress();
        $this->assertStringContainsString($address, $render);

        /** @var string $taxNumber */
        $taxNumber = $donor->getTaxNumber();
        $this->assertStringContainsString($taxNumber, $render);
    }

    protected function getPackageProviders($app): array
    {
        return [
            InisiatifTemplateServiceProvider::class,
        ];
    }
}
