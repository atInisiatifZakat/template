<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Bridge;

use DateTimeInterface;
use InvalidArgumentException;

final class Donation
{
    /**
     * @var string
     */
    private $identificationNumber;

    /**
     * @var DateTimeInterface
     */
    private $date;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $branchName;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float
     */
    private $totalAmount;
    
    /**
     * @var string
     */
    private $currency;
    
    /**
     * @var float
     */
    private $currencyRate;

    private function __construct(string $identificationNumber, DateTimeInterface $date, float $amount, string $branchName, string $type, float $totalAmount, string $currency, float $currencyRate)
    {
        $this->identificationNumber = $identificationNumber;
        $this->date = $date;
        $this->amount = $amount;
        $this->branchName = $branchName;
        $this->type = $type;
        $this->totalAmount = $totalAmount;
        $this->currency = $currency;
        $this->currencyRate = $currencyRate;
    }

    public static function fromArray(array $input): self
    {
        if (
            ! array_key_exists('identification_number', $input)
            || ! array_key_exists('date', $input)
            || ! array_key_exists('amount', $input)
            || ! array_key_exists('branch_name', $input)
            || ! array_key_exists('type', $input)
            || ! array_key_exists('total_amount', $input)
            || ! array_key_exists('currency', $input)
            || ! array_key_exists('currency_rate', $input)
        ) {
            throw new InvalidArgumentException();
        }

        $identificationNumber = $input['identification_number'];
        $date = $input['date'];
        $amount = is_int($input['amount']) ? (float) $input['amount'] : $input['amount'];
        $branchName = $input['branch_name'];
        $type = $input['type'];
        $totalAmount = (float) $input['total_amount'];
        $currency = $input['currency'];
        $currencyRate = (float) $input['currency_rate'];

        if (! is_string($identificationNumber) || ! is_float($amount)|| ! is_float($totalAmount) || ! $date instanceof DateTimeInterface || ! is_string($branchName)) {
            throw new InvalidArgumentException();
        }

        return new self($identificationNumber, $date, $amount, $branchName, $type, $totalAmount, $currency, $currencyRate);
    }

    public function getIdentificationNumber(): string
    {
        return $this->identificationNumber;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAmountFormatted(): string
    {
        return number_format($this->getAmount(), 0, '.', '.');
    }

    public function getBranchName(): string
    {
        return $this->branchName;
    }

    public function getCurrency(): string
    {
        return $this->currency ?? 'IDR';
    }

    public function getCurrencyRate(): float
    {
        return $this->currencyRate ?? 1;
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
