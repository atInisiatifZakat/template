<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Setor Zakat</title>

    <style>
        .bsz-box {
            margin: auto;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .bsz-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .bsz-box table, th, td {
            border: 0.1rem solid black;
        }

        .no-border {
            border: none !important;
        }

        @media print {
            @page {
                size: A5;
                margin: 1em;
            }

            body {
                height: auto;
                width: 148.5mm;
                margin: 0;
            }
        }
    </style>
</head>
<body>
<div class="bsz-box">
    <table>
        <tr>
            <td style="text-align: center; padding: 0.25em 0.25em 0 0.25em;" width="20%">
                <img src="https://inisiatif-assets.imgix.net/bsz/kementerian-agama-logo.png" height="65"
                     alt="Kementrian Agama RI">
            </td>
            <td style="text-align: center;">
                <h2 style="margin: 0.5em">BUKTI SETOR ZAKAT</h2>
                <h5 style="margin: 0.5em; letter-spacing: 0.2em;">
                    {{ sprintf('IZI/BSZ/%s/%s', $donation->getDate()->format('Y'), $donation->getIdentificationNumber()) }}
                </h5>
            </td>
            <td style="text-align: center; padding: 0.25em 0.25em 0 0.25em;" width="20%">
                <img src="https://inisiatif-assets.imgix.net/bsz/logo-inisiatif-zakat-indonesia.png" height="60"
                     alt="Inisiatif Zakat Indonesia">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table class="no-border"
                       style="margin-top: 0.75em; margin-bottom: 0.75em; font-size: 0.7em; line-height: 160%;">
                    <tr>
                        <td class="no-border" style="text-align: center;">
                            <p style="font-weight: bold; margin: 0; font-size: 1.5em; line-height: 170%;">
                                Yayasan Inisiatif Zakat Indonesia
                            </p>
                            <p style="margin: 0;">
                                LAZNAS SK Kemenag RI No. 423 Tahun 2015
                            </p>
                            <p style="margin: 0;">
                                Alamat Jl. Raya Condet No. 54 D-E Batu Ampar Jakarta Timur 13520 - Indonesia
                            </p>
                            <p style="margin: 0;">
                                Telp : (021) 87787325 Fax : (021) 87787603
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="no-border" style="margin-top: 1em; margin-bottom: 1em; font-size: 0.75em; line-height: 160%;">
        <tr>
            <td class="no-border" style="width: 25%; text-align: right; padding-right: 1em; vertical-align: top;">
                NPWP
            </td>
            <td class="no-border" style="letter-spacing: 0.2em;">
                {{ $donor->getTaxNumber() ?: '' }}
            </td>
        </tr>
        <tr>
            <td class="no-border" style="width: 25%; text-align: right; padding-right: 1em; vertical-align: top;">
                NPWZ
            </td>
            <td class="no-border" style="letter-spacing: 0.2em;">
                {{ $donor->getIdentificationNumber() }}
            </td>
        </tr>
        <tr>
            <td class="no-border" style="width: 25%; text-align: right; padding-right: 1em; vertical-align: top;">
                Nama Wajib Zakat
            </td>
            <td class="no-border">
                {{ $donor->getName() }}
            </td>
        </tr>
        <tr>
            <td class="no-border" style="width: 25%; text-align: right; padding-right: 1em; vertical-align: top;">
                Alamat Wajib Zakat
            </td>
            <td class="no-border">
                {{ $donor->getAddress() }}
            </td>
        </tr>
    </table>

    <table style="margin-top: 1em; margin-bottom: 1em; font-size: 0.75em; line-height: 160%;">
        <tr style="text-align: center;">
            <th style="text-align: center; width: 1em; height: 3em;">No.</th>
            <th style="width: 75%; height: 3em;">Objek Zakat</th>
            <th style="height: 3em;">Jumlah Zakat</th>
        </tr>
        @foreach($details as $detail)
            <tr>
                <td style="text-align: center; width: 1em; padding: 0.25em 0.5em 0.25em 0.5em;">{{ $loop->iteration }}</td>
                <td style="width: 75%; padding: 0.25em 0.5em 0.25em 0.5em;">{{ $detail->getFundingName() }}</td>
                <td style="text-align: right; padding: 0.25em 0.5em 0.25em 0.5em;">{{ sprintf('Rp. %s', $detail->getAmountFormatted()) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"
                style="width: 75%; padding: 0.25em 0.5em 0.25em 0.5em; font-weight: bold; text-align: right;">Total
            </td>
            <td style="text-align: right; padding: 0.25em 0.5em 0.25em 0.5em; font-weight: bold;">{{ sprintf('Rp. %s', $donation->getAmountFormatted()) }}</td>
        </tr>
    </table>

    <table class="no-border" style="margin-top: 1em; margin-bottom: 1em; font-size: 0.75em; line-height: 160%;">
        <tr class="no-border">
            <td class="no-border" style="font-weight: bold; vertical-align: top; width: 15%;">Terbilang</td>
            <td style="height: 3em; padding: 0.25em 0.5em 0.25em 0.5em; font-weight: bold; vertical-align: top;">
                {{ \Inisiatif\Package\Template\Rupiah::titleCase($donation->getAmount()) }}
            </td>
        </tr>
    </table>

    <table style="margin-top: 1em; margin-bottom: 1em; font-size: 0.75em;">
        <tr>
            <td style="width: 50%; text-align: center; background-repeat: no-repeat; background-size: 75%; background-position: center bottom; background-image:url('data:image/jpeg;base64,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')">
                <p style="line-height: 50%;">Diterima oleh LAZNAS IZI</p>
                <p style="line-height: 50%;">{{ mb_convert_case($donation->getBranchName(), MB_CASE_TITLE, 'UTF-8') }}
                    , {{ $donation->getDate()->format('d - m - Y') }}</p>
                <br/><br/><br/>
                <p style="line-height: 50%; font-weight: bold; margin-top: -1em;">
                    {{ mb_convert_case('Rizqi Rohmat Fahmi Hidayat', MB_CASE_TITLE, 'UTF-8') }}
                </p>
            </td>
            <td style="width: 50%; text-align: center; ">
                <p style="line-height: 50%;">Penyetor / Wajib Zakat</p>
                <p style="line-height: 50%;">{{ mb_convert_case($donation->getBranchName(), MB_CASE_TITLE, 'UTF-8') }}
                    , {{ $donation->getDate()->format('d - m - Y') }}</p>
                <br/><br/><br/>
                <p style="line-height: 50%; font-weight: bold; margin-top: -1em;">
                    {{ $donor->getName() }}
                </p>
            </td>
        </tr>
    </table>

    <table class="no-border" style="margin-top: 2em; margin-bottom: 1em; font-size: 0.65em;text-align: justify;">
        <tr class="no-border">
            <td class="no-border" style="vertical-align: top;font-weight: bold;">
                Keterangan :
            </td>
        </tr>
        <tr class="no-border">
            <td class="no-border" style="vertical-align: top;">
                <ul style="margin-top: 0;padding-left: 1.25em">
                    @foreach($disclaimers as $disclaimer)
                        <li style="margin-top: 0;line-height: 160%">
                            {{ $disclaimer }}
                        </li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
