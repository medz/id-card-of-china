<?php

declare(strict_types=1);

namespace Medz\IdentityCard\China;

use Medz\IdentityCard\China\Region\RegionInterface;

interface IdentityInterface
{
    /**
     * Check The ID Card is legal.
     * 
     * @return bool
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function legal(): bool;

    /**
     * Get Region of The ID Card People.
     */
    public function region(): RegionInterface;

    /**
     * Get The ID Card People Birthday.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function birthday(): string;

    /**
     * Get the ID Card People Gender.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function gender(): string;
}
