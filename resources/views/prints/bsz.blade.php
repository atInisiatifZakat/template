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
                ID Donor
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
            <td style="width: 50%; text-align: center; background-repeat: no-repeat; background-size: 45%; background-position: center bottom; background-image:url('data:image/jpeg;base64,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')">
                <p style="line-height: 50%;">Diterima oleh LAZNAS IZI</p>
                <p style="line-height: 50%;">{{ $donation->getBranchName() }}
                    , {{ $donation->getDate()->format('d - m - Y') }}</p>
                <br/><br/><br/>
                <p style="line-height: 50%; font-weight: bold; margin-top: -1em;">
                    {{ mb_convert_case('Anah Herlina', MB_CASE_TITLE, 'UTF-8') }}
                </p>
            </td>
            <td style="width: 50%; text-align: center; ">
                <p style="line-height: 50%;">Penyetor / Wajib Zakat</p>
                <p style="line-height: 50%;">{{ $donation->getBranchName() }}
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
