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

    /**
     * @var float
     */
    private $totalAmount;

    /**
     * @var ?string
     */
    private $currency;

    /**
     * @var ?float
     */
    private $currencyRate;

    private function __construct(string $fundingName, ?string $programName, float $amount, ?string $goodName, ?int $goodRate, ?int $goodQuantity, ?string $goodUnit, ?float $totalAmount, ?string $currency, ?float $currencyRate)
    {
        $this->fundingName = $fundingName;
        $this->programName = $programName;
        $this->amount = $amount;
        $this->goodName = $goodName;
        $this->goodRate = $goodRate;
        $this->goodQuantity = $goodQuantity;
        $this->goodUnit = $goodUnit;
        $this->totalAmount = $totalAmount;
        $this->currency = $currency;
        $this->currencyRate = $currencyRate;
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
        $goodUnit = array_key_exists('good_unit', $input) ? $input['good_unit'] : null;
        $totalAmount = is_int($input['total_amount']) ? (float) $input['total_amount'] : $input['total_amount'];
        $currency = array_key_exists('currency', $input) ? $input['currency'] : null;
        $currencyRate = is_int($input['currency_rate']) ? (float) $input['currency_rate'] : $input['currency_rate'];


        if (!is_string($fundingName) || !is_float($amount) || !is_float($totalAmount)) {
            throw new InvalidArgumentException();
        }

        return new self($fundingName, $programName, $amount, $goodName, $goodRate, $goodQuantity, $goodUnit, $totalAmount, $currency, $currencyRate);
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
        return number_format($this->getAmount(), 0, '.', '.');
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
    
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getCurrencyRate(): ?float
    {
        return $this->currencyRate;
    }

    public function getTotalAmount(): float
    {
        if (!$this->totalAmount) {
            return $this->getAmount() * $this->getCurrencyRate();
        }

        return $this->totalAmount;
    }
    
    public function getTotalAmountFormatted(): string
    {
        return number_format($this->getTotalAmount());
    }
}
