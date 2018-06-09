<?php

declare(strict_types=1);

namespace Medz\IdentityCard\China;

use Medz\IdentityCard\China\Region\Region;
use Medz\IdentityCard\China\Region\RegionInterface;

class Identity implements IdentityInterface
{
    protected $identityCardNumber;

    public function __construct(string $identityCardNumber)
    {
        $identityCardNumber = str_replace(' ', '', $identityCardNumber);
        $identityCardNumber = str_replace('-', '', $identityCardNumber);
        $identityCardNumber = str_replace('_', '', $identityCardNumber);
        $this->identityCardNumber = strtoupper($identityCardNumber);
    }

    /**
     * Check The ID Card is legal.
     * 
     * @return bool
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function legal(): bool
    {
        $regionCode = (int) substr($this->identityCardNumber, 0, 6);

        return ($regionCode >= 110000
         && $regionCode <= 820000
         && checkdate(
             intval(substr($this->identityCardNumber, 10, 2)),
             intval(substr($this->identityCardNumber, 12, 2)),
             intval(substr($this->identityCardNumber, 6, 4))
            )
         && $this->validateCheckCode()
        );
    }

    /**
     * Get The ID Card People Birthday.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function birthday(): string
    {
        $year = substr($this->identityCardNumber, 6, 4);
        $month = substr($this->identityCardNumber, 10, 2);
        $day = substr($this->identityCardNumber, 12, 2);

        return sprintf('%s-%s-%s', $year, $month, $day);
    }

    /**
     * Get the ID Card People Gender.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function gender(): string
    {
        return ((intval(substr($this->identityCardNumber, 16, 1)) % 2) === 0) ? '女' : '男';
    }

    /**
     * Get Region of The ID Card People.
     */
    public function region(): RegionInterface
    {
        $regionCode = (int) substr($this->identityCardNumber, 0, 6);

        return new Region($regionCode);
    }

    public function validateCheckCode(): bool
    {
        // Init
        $identityCardNumber = $this->identityCardNumber;
        $index = $sum = 0;

        // Calculation $sum
        for ($index; $index < 17; $index++) {
            $sum += ((1 << (17 - $index)) % 11) * intval(substr($identityCardNumber, $index, 1));
        }

        // Calculation $quotiety
        $quotiety = (12 - ($sum % 11)) % 11;

        if ($quotiety < 10) {
            return intval(substr($identityCardNumber, 17, 1)) === $quotiety;
        }

        return $quotiety === 10;
    }
}
