<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template;

use Illuminate\Http\Response;
use Barryvdh\Snappy\PdfWrapper;
use Inisiatif\Package\Template\Bridge\Donor;
use Inisiatif\Package\Template\Bridge\Donation;

final class Bsz
{
    private PdfWrapper $pdf;
    private string $paperSize = 'A5';

    public function __construct(PdfWrapper $pdf)
    {
        $this->pdf = $pdf;
    }

    public function make(Donor $donor, Donation $donation, array $details): self
    {
        $this->pdf->loadView('inisiatif::prints.bsz', compact('donation', 'donor', 'details'))
            ->setPaper($this->paperSize)
            ->setOption('margin-bottom', '4mm')
            ->setOption('margin-left', '2mm')
            ->setOption('margin-right', '2mm')
            ->setOption('margin-top', '4mm')
            ->setOption('page-height', '210mm')
            ->setOption('page-width', '148mm');

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
