<?php

declare(strict_types=1);

return [
    'modify_pdf_pin' => env('MODIFY_PDF_PIN'), // PIN UNTUK MENGUBAH PDF
    'use_arcfour_fallback' => env('USE_ARCFOUR_FALLBACK', true), // FALLBACK UNTUK IMPLEMENTASI RC4-40. ATUR MENJADI TRUE JIKA MENGGUNAKAN OPENSSL 3.0.
];
