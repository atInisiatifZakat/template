<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template;

use Illuminate\Http\Response;
use Barryvdh\Snappy\PdfWrapper;
use Inisiatif\Package\Template\Bridge\Donation;
use Inisiatif\Package\Template\Bridge\Donor;

final class Invoice
{
    private PdfWrapper $pdf;
    private string $paperSize = 'A4';

    public function __construct(PdfWrapper $pdf)
    {
        $this->pdf = $pdf;
    }

    public function make(Donor $donor, Donation $donation, $withSignature = true, array $details): self
    {
        $this->pdf->loadView('inisiatif::prints.invoice', compact('donation', 'donor', 'details', 'withSignature'))
            ->setPaper($this->paperSize)
            ->setOption('margin-bottom', '8mm')
            ->setOption('margin-left', '4mm')
            ->setOption('margin-right', '4mm')
            ->setOption('margin-top', '8mm');

        return $this;
    }

    public function download(string $fileName): Response
    {
        return new Response($this->output(), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'attachment; filename="' . $fileName . '"'
        ));
    }

    public function inline(string $fileName): Response
    {
        return new Response($this->output(), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ));
    }

    public function output(): string
    {
        $tmp = $this->pdf->output();
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $tmp);
        rewind($stream);

        $protectedPdf = PdfProtector::protect($stream, $this->paperSize);

        fclose($stream);

        return $protectedPdf;
    }
}
