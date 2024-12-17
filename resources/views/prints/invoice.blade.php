<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>KUITANSI #{{ $donation->getIdentificationNumber() }} </title>
    <style>
        body {
            margin: 0;
        }

        .box {
            margin: auto;
            font-size: 14px;
            line-height: 1.2;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #000000;
            border-top: 10px solid #0ea432;
            border-right: 1px solid grey;
            border-left: 1px solid grey;
            border-bottom: 1px solid grey;
        }

        .logo-container {
            margin: 20px 0 0 1rem;
        }

        .content-container {
            margin: 10px;
        }

        .title {
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }

        .description {
            line-height: 22px;
            text-align: justify;
        }

        .transaction-status {
            background-color: #ddd;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .transaction-status table {
            font-size: 14px;
            width: 100%;
        }

        .transaction-status table td {
            padding: 3px;
        }

        .transaction-header {
            background-color: #0ea432;
            color: #fff;
            font-weight: bold;
            display: block;
            padding: 5px;
            margin: 10px 0 0;
        }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-header {
            background-color: #ddd;
        }

        .header-cell {
            vertical-align: middle;
            text-align: left;
            font-weight: bold;
            padding: 10px 5px;
        }

        .right-align {
            text-align: right;
        }

        .table-body {
            border-bottom: 1px solid grey;
        }

        .body-cell {
            vertical-align: top;
            text-align: left;
            padding: 10px 5px;
        }

        .funding-name {
            margin: 0;
            line-height: 1
        }

        .funding-description {
            margin: 5px 0 0 0;
            line-height: 1;
            color: #868686
        }

        .amount-cell {
            text-align: right;
            width: 5rem;
            white-space: nowrap;
        }

        .footer-cell {
            vertical-align: top;
            text-align: right;
            padding: 10px 5px;
            font-weight: bold;
        }

        .closing-text {
            margin: 10px 0 1em 0;
            line-height: 22px;
            text-align: justify;
        }

        .signature-table {
            margin-left: 6em;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .signature-cell {
            width: 50%;
            text-align: center;
            position: relative;
        }

        .signature-text {
            line-height: 50%;
            z-index: 2;
        }

        .signature-date {
            line-height: 50%;
            margin-bottom: 4.5rem;
            z-index: 2;
        }

        .signature-name {
            line-height: 50%;
            font-weight: bold;
            z-index: 2;
        }

        .signature-image {
            top: 38px;
            position: absolute;
            left: 30px;
            height: 110px;
            z-index: 1;
        }

        .footer-container {
            margin: 10px;
        }

        .notes-section {
            margin-top: 2em;
        }

        .notes-title {
            font-size: 10.5px;
            line-height: 21px;
            text-align: left;
        }

        .notes-list {
            font-size: 10.5px;
            text-align: justify;
            margin-left: 0;
            padding-left: 1em;
        }

        @page {
            margin-top: 10mm;
            margin-right: 4mm;
            margin-bottom: 4mm;
            margin-left: 4mm;
        }
    </style>
</head>

@php
    $logoImg =
        'data:image/png;base64,' .
        base64_encode(file_get_contents('http://donation.inisiatif.id/images/logo-inisiatif-zakat-indonesia.png'));

    $signatureImg =
        'data:image/jpeg;base64,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';

@endphp

<body>
    <div class="box">
        <div class="logo-container">
            <img src="{{ $logoImg }}" height="60" alt="Inisiatif Zakat Indonesia" />
        </div>

        <div class="content-container">
            <p class="title">KUITANSI</p>

            <p>Kepada Bapak/Ibu <strong>{{ $donor->getName() }}</strong></p>
            <p class="description">
                Kuitansi ini adalah bukti pembayaran zakat, infaq dan shodaqoh Anda di
                Inisiatif Zakat Indonesia. Berikut kami sertakan detail pembayaran
                Anda:
            </p>
            <div class="transaction-status">
                <table>
                    <tbody>
                        <tr>
                            <td><b>Nomor Donatur</b></td>
                            <td>:</td>
                            <td>{{ $donor->getIdentificationNumber() }}</td>
                            <td><b>Nomor Transaksi</b></td>
                            <td>:</td>
                            <td>{{ $donation->getIdentificationNumber() }}</td>
                        </tr>
                        <tr>
                            <td><b>Nama Donatur</b></td>
                            <td>:</td>
                            <td>{{ $donor->getName() }}</td>
                            <td><b>Tanggal Transaksi</b></td>
                            <td>:</td>
                            <td>{{ $donation->getDate()->format('d - m - Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="transaction-header">Detail Transaksi</div>
            <table class="transaction-table">
                <thead class="table-header">
                    <tr>
                        <td class="header-cell">Jenis Transaksi</td>
                        <td class="header-cell">Program</td>
                        <td class="header-cell right-align">Sub Total</td>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($details as $detail)
                        <tr>
                            <td class="body-cell">
                                <p class="funding-name">{{ $detail->getFundingName() }}</p>
                                @if ($donation->getType() === 'GOOD')
                                    <p class="funding-description">Beras 10 Kg</p>
                                @endif
                            </td>
                            <td class="body-cell">{{ $detail->getProgramName() }}</td>
                            <td class="body-cell amount-cell">
                                {{ sprintf('Rp. %s', $detail->getAmountFormatted()) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="footer-cell">Total Transaksi</td>
                        <td class="footer-cell amount-cell">
                            {{ sprintf('Rp. %s', $donation->getAmountFormatted()) }}
                        </td>
                    </tr>
                </tfoot>
            </table>

            <p class="closing-text">
                Semoga Allah memberikan pahala atas apa yang telah Bapak/Ibu
                {{ $donor->getName() }}{{ ' ' }}
                tunaikan, semoga Allah memberikan keberkahan atas harta yang masih
                tertinggal dan semoga
                <strong>zakat, infaq dan shodaqoh</strong> ini menjadi pembersih bagi
                jiwa dan harta Bapak/Ibu {{ $donor->getName() }} beserta keluarga.
            </p>
        </div>

        <table class="signature-table">
            <tbody>
                <tr>
                    <td class="signature-cell">
                        <p class="signature-text">Diterima oleh LAZNAS IZI</p>
                        <p class="signature-date">
                            {{ $donation->getBranchName() }}, {{ $donation->getDate()->format('d - m - Y') }}
                        </p>
                        @if ($withSignature)
                            <img class="signature-image" src="{{ $signatureImg }}" alt="IZI Signature">
                        @endif
                        <p class="signature-name">Anah Herlina</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer-container">
            <div class="notes-section">
                <p class="notes-title">
                    <strong>Keterangan :</strong>
                </p>
                <ol class="notes-list">
                    <li>
                        Inisiatif Zakat Indonesia terdaftar sebagai lembaga penerbit Bukti
                        Setor Zakat (BSZ) untuk pengurangan penghasilan kena pajak
                        berdasarkan peraturan Dirjen Pajak No. PER-11/PJ/2017.
                    </li>
                    <li>
                        Inisiatif Zakat Indonesia tidak menerima segala bentuk dana yang
                        terkait dengan terorisme dan pencucian uang.
                    </li>
                    <li>
                        Untuk memenuhi kepatuhan terhadap Syariah serta Undang - Undang
                        No. 23 Tahun 2011 tentang Pengelolaan Zakat. data zakat yang
                        disetorkan oleh Penyetor (Muzaki) telah sesuai dengan
                        kriteria/syarat wajib zakat, yaitu: (1) Muslim, (2) Milik
                        Sempurna, (3) Cukup Nisab, (4) Cukup Haul, (5) Bersumber dari dana
                        yang halal.
                    </li>
                    <li>
                        Transkasi Zakat dapat dikreditkan sebagai pengurangan Penghasilan
                        Kena Pajak sesuai ketentuan yang berlaku (Pasal 9 ayat 1 huruf g
                        UU No. 36 Th.2008 tentang Pajak Penghasilan).
                    </li>
                </ol>
            </div>
        </div>
    </div>
</body>

</html>
