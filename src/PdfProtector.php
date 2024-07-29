<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template;

use setasign\FpdiProtection\FpdiProtection;

final class PdfProtector
{
    public static function protect($source, $paperSize)
    {
        $pin = config('template.modify_pdf_pin', 'IZI_PIN');

        $useArcfourFallback = config('template.use_arcfour_fallback', true);

        $protectedPdf = new FpdiProtection('P', 'mm', $paperSize, $useArcfourFallback);

        $pagecount = $protectedPdf->setSourceFile($source);

        for ($loop = 1; $loop <= $pagecount; $loop++) {
            $templateId = $protectedPdf->importPage($loop);
            $protectedPdf->addPage('P', $paperSize);
            $protectedPdf->useTemplate($templateId);
        }

        $protectedPdf->setProtection([FpdiProtection::PERM_PRINT], '', $pin);
        return $protectedPdf->output("S");
    }
}
