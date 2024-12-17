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

    private function __construct(string $identificationNumber, DateTimeInterface $date, float $amount, string $branchName, string $type)
    {
        $this->identificationNumber = $identificationNumber;
        $this->date = $date;
        $this->amount = $amount;
        $this->branchName = $branchName;
        $this->type = $type;
    }

    public static function fromArray(array $input): self
    {
        if (
            ! array_key_exists('identification_number', $input)
            || ! array_key_exists('date', $input)
            || ! array_key_exists('amount', $input)
            || ! array_key_exists('branch_name', $input)
            || ! array_key_exists('type', $input)
        ) {
            throw new InvalidArgumentException();
        }

        $identificationNumber = $input['identification_number'];
        $date = $input['date'];
        $amount = is_int($input['amount']) ? (float) $input['amount'] : $input['amount'];
        $branchName = $input['branch_name'];
        $type = $input['type'];

        if (! is_string($identificationNumber) || ! is_float($amount) || ! $date instanceof DateTimeInterface || ! is_string($branchName)) {
            throw new InvalidArgumentException();
        }

        return new self($identificationNumber, $date, $amount, $branchName, $type);
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
        return number_format($this->getAmount());
    }

    public function getBranchName(): string
    {
        return $this->branchName;
    }
}
