<?php

declare(strict_types=1);

namespace Medz\IdentityCard\China\Region;

use Medz\GBT2260\Getter;

class Region implements RegionInterface
{
    /**
     * The Init Region Code.
     * 
     * @var int
     */
    protected $code;

    /**
     * Create A Region instance.
     * 
     * @param int $regionCode The Instance Init Region Code.
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function __construct(int $regionCode)
    {
        // Setting init region code.
        $this->code = (string) $regionCode;
    }

    /**
     * Get the Region Code.
     * 
     * @return int
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function code(): int
    {
        return (int) $this->code;
    }

    /**
     * Get Province Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function province(): ?string
    {
        return Getter::instance()->province((string) $this->code);
    }

    /**
     * Get City Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function city(): ?string
    {
        return Getter::instance()->city((string) $this->code);
    }

    /**
     * Get County Of The Region.
     * 
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function county(): ?string
    {
        return Getter::instance()->county((string) $this->code);
    }

    /**
     * Get The Region Tree.
     * 
     * @return array
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function tree(): array
    {
        return array_values(array_filter([
            $this->province(),
            $this->city(),
            $this->county(),
        ]));
    }

    /**
     * Get The Region Tree String.
     * 
     * @param string $glue Join Array Elements With A Glue String
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function treeString(string $glue = ''): string
    {
        return implode($glue, $this->tree());
    }
}
