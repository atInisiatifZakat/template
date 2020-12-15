<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template;

final class Rupiah
{
    /**
     * @param int|float $number
     */
    public static function titleCase($number): ?string
    {
        $str = self::str($number);

        return $str === null ? null : mb_convert_case($str, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param int|float $number
     */
    public static function str($number): ?string
    {
        $str = $number === 0 ? 'nol' : self::convert($number);

        return $str === null ? null : sprintf('%s rupiah', trim($str));
    }

    /**
     * @param int|float $number
     */
    private static function convert($number): ?string
    {
        /** @var int|float $nominal */
        $nominal = $number < 0 ? $number *= -1 : $number;

        $numberStrings = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas',
        ];

        if ($nominal < 12) {
            return sprintf(' %s', $numberStrings[$nominal]);
        }

        if ($nominal < 20) {
            return self::convert($nominal - 10) . ' belas';
        }

        if ($nominal < 100) {
            return self::convert($nominal / 10) . ' puluh'
                . self::convert($nominal % 10);
        }

        if ($nominal < 200) {
            return ' seratus' . static::convert($nominal - 100);
        }

        if ($nominal < 1000) {
            return self::convert($nominal / 100) . ' ratus'
                . self::convert($nominal % 100);
        }

        if ($nominal < 2000) {
            return ' seribu' . self::convert($nominal - 1000);
        }

        if ($nominal < 1000000) {
            return self::convert($nominal / 1000) . ' ribu'
                . self::convert($nominal % 1000);
        }

        if ($nominal < 1000000000) {
            return self::convert($nominal / 1000000) . ' juta'
                . self::convert($nominal % 1000000);
        }

        if ($nominal < 1000000000000) {
            return self::convert($nominal / 1000000000) . ' milyar'
                . self::convert(fmod($nominal, 1000000000));
        }

        if ($nominal < 1000000000000000) {
            return self::convert($nominal / 1000000000000) . ' trilyun'
                . self::convert(fmod($nominal, 1000000000000));
        }

        return null;
    }
}
