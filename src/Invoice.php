<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template;

use Illuminate\Http\Response;
use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Support\Facades\View;
use Inisiatif\Package\Template\Bridge\Donation;
use Inisiatif\Package\Template\Bridge\Donor;

final class Invoice
{
    private PdfWrapper $pdf;

    public function __construct(PdfWrapper $pdf)
    {
        $this->pdf = $pdf;
    }

    public function make(Donor $donor, Donation $donation, array $details): self
    {
        $this->pdf->loadView('inisiatif::prints.invoice', compact('donation', 'donor', 'details'))
            ->setPaper('A4')
            ->setOption('margin-bottom', '8mm')
            ->setOption('margin-left', '4mm')
            ->setOption('margin-right', '4mm')
            ->setOption('margin-top', '8mm');

        return $this;
    }

    public function download(string $fileName): Response
    {
        return $this->pdf->download($fileName);
    }

    public function inline(string $fileName): Response
    {
        return $this->pdf->inline($fileName);
    }

    public function output(): string
    {

        return $this->pdf->output();
    }
}
