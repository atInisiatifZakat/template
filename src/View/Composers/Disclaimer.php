<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\View\Composers;

use Illuminate\View\View;

final class Disclaimer
{
    /**
     * @var array
     */
    private $disclaimers = [
        'Inisiatif Zakat Indonesia terdaftar sebagai lembaga penerbit Bukti Setor Zakat (BSZ) untuk pengurangan penghasilan kena pajak berdasarkan peraturan Dirjen Pajak No. PER-08/PJ/2021.',
        'Inisiatif Zakat Indonesia tidak menerima segala bentuk dana yang terkait dengan terorisme dan pencucian uang.',
        'Untuk memenuhi kepatuhan terhadap Syariah serta Undang - Undang No. 23 Tahun 2011 tentang Pengelolaan Zakat. data zakat yang disetorkan oleh Penyetor (Muzaki) telah sesuai dengan kriteria/syarat wajib zakat, yaitu: (1) Muslim, (2) Milik Sempurna, (3) Cukup Nisab, (4) Cukup Haul, (5) Bersumber dari dana yang halal.',
        'Transkasi Zakat dapat dikreditkan sebagai pengurangan Penghasilan Kena Pajak sesuai ketentuan yang berlaku (Pasal 9 ayat 1 huruf g UU No. 36 Th.2008 tentang Pajak Penghasilan).',
    ];

    public function compose(View $view): void
    {
        $view->with('disclaimers', $this->disclaimers);
    }
}
