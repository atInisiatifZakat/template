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
     * @var string
     */
    private $programName;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var ?string
     */
    private $goodName;

    /**
     * @var ?int
     */
    private $goodRate;

    /**
     * @var ?int
     */
    private $goodQuantity;

    /**
     * @var ?string
     */
    private $goodUnit;

    private function __construct(string $fundingName, ?string $programName, float $amount, ?string $goodName, ?int $goodRate, ?int $goodQuantity, ?string $goodUnit)
    {
        $this->fundingName = $fundingName;
        $this->programName = $programName;
        $this->amount = $amount;
        $this->goodName = $goodName;
        $this->goodRate = $goodRate;
        $this->goodQuantity = $goodQuantity;
        $this->goodUnit = $goodUnit;
    }

    public static function fromArray(array $input): self
    {
        if (!array_key_exists('funding_name', $input) || !array_key_exists('amount', $input)) {
            throw new InvalidArgumentException();
        }

        $fundingName = $input['funding_name'];
        $programName = array_key_exists('program_name', $input) ? $input['program_name'] : null;
        $amount = is_int($input['amount']) ? (float) $input['amount'] : $input['amount'];
        $goodName = array_key_exists('good_name', $input) ? $input['good_name'] : null;
        $goodRate = array_key_exists('good_rate', $input) ? $input['good_rate'] : null;
        $goodQuantity = array_key_exists('good_quantity', $input) ? $input['good_quantity'] : null;
        $goodUnit = array_key_exists('unit', $input) ? $input['unit'] : null;


        if (!is_string($fundingName) || !is_float($amount)) {
            throw new InvalidArgumentException();
        }

        return new self($fundingName, $programName, $amount, $goodName, $goodRate, $goodQuantity, $goodUnit);
    }

    public function getFundingName(): string
    {
        return $this->fundingName;
    }

    public function getProgramName(): ?string
    {
        return $this->programName;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAmountFormatted(): string
    {
        return number_format($this->getAmount());
    }

    public function getGoodName(): ?string
    {
        return $this->goodName;
    }

    public function getGoodRate(): ?int
    {
        return $this->goodRate;
    }

    public function getGoodQuantity(): ?int
    {
        return $this->goodQuantity;
    }

    public function getGoodUnit(): ?string
    {
        return $this->goodUnit;
    }
}
