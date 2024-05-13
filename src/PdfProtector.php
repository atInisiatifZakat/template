<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template;

use setasign\FpdiProtection\FpdiProtection;

final class PdfProtector
{
    public function protect(string $path)
    {
        $pin = config('donation.modify_pdf_pin', 'IZI_PIN');

        $protectedPdf = new FpdiProtection();

        $protectedPdf->setSourceFile($path);
        $pagecount = $protectedPdf->setSourceFile($path);

        for ($loop = 1; $loop <= $pagecount; $loop++) {
            $templateId = $protectedPdf->importPage($loop);
            $protectedPdf->addPage();
            $protectedPdf->useTemplate($templateId);
        }

        $protectedPdf->setProtection([FpdiProtection::PERM_PRINT], $pin);
        return $protectedPdf->output("S");
    }
}
