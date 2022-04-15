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
