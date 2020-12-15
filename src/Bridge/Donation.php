<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Bridge;

use DateTimeInterface;
use InvalidArgumentException;

final class Donation
{
    /**
     * @var int
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

    private function __construct(int $identificationNumber, DateTimeInterface $date, float $amount, string $branchName)
    {
        $this->identificationNumber = $identificationNumber;
        $this->date = $date;
        $this->amount = $amount;
        $this->branchName = $branchName;
    }

    public static function fromArray(array $input): self
    {
        if (! array_key_exists('identification_number', $input)
            || ! array_key_exists('date', $input)
            || ! array_key_exists('amount', $input)
            || ! array_key_exists('branch_name', $input)) {
            throw new InvalidArgumentException();
        }

        $identificationNumber = $input['identification_number'];
        $date = $input['date'];
        $amount = is_int($input['amount']) ? (float) $input['amount'] : $input['amount'];
        $branchName = $input['branch_name'];

        if (! is_int($identificationNumber) || ! is_float($amount) || ! $date instanceof DateTimeInterface || ! is_string($branchName)) {
            throw new InvalidArgumentException();
        }

        return new self($identificationNumber, $date, $amount, $branchName);
    }

    public function getIdentificationNumber(): int
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

    public function getAmountFormatted(): string
    {
        return number_format($this->getAmount());
    }

    public function getBranchName(): string
    {
        return $this->branchName;
    }
}
