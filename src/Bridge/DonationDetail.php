<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Bridge;

use InvalidArgumentException;

final class DonationDetail
{
    /**
     * @var string
     */
    private $fundingName;

    /**
     * @var float
     */
    private $amount;

    private function __construct(string $fundingName, float $amount)
    {
        $this->fundingName = $fundingName;
        $this->amount = $amount;
    }

    public static function fromArray(array $input): self
    {
        if (! array_key_exists('funding_name', $input) || ! array_key_exists('amount', $input)) {
            throw new InvalidArgumentException();
        }

        $fundingName = $input['funding_name'];
        $amount = is_int($input['amount']) ? (float) $input['amount'] : $input['amount'];

        if (! is_string($fundingName) || ! is_float($amount)) {
            throw new InvalidArgumentException();
        }

        return new self($fundingName, $amount);
    }

    public function getFundingName(): string
    {
        return $this->fundingName;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAmountFormatted(): string
    {
        return number_format($this->getAmount());
    }
}
