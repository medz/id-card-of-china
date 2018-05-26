<?php

declare(strict_types=1);

namespace Medz\IdentityCard\China\Region;

interface RegionInterface
{
    /**
     * Get Province Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function province(): string;

    /**
     * Get City Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function city(): string;

    /**
     * Get County Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function county(): string;

    /**
     * Get The Region Tree.
     * 
     * @return array
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function tree(): array;

    /**
     * Get The Region Tree String.
     * 
     * @param string $spacer Set Implode String
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function treeString(string $spacer = ' '): string;
}
