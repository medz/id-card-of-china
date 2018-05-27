<?php

declare(strict_types=1);

namespace Medz\IdentityCard\China\Tests\Region;

use Medz\IdentityCard\China\Tests\TestCase;
use Medz\IdentityCard\China\Region\Region;
use Medz\IdentityCard\China\Region\RegionInterface;

class RegionTest extends TestCase
{
    /**
     * Test instance of RegionInterface
     */
    public function testInterface()
    {
        $regionMock = $this->getMockBuilder(Region::class)
            ->disableOriginalConstructor()
            // ->setMethods(['setCode'])
            ->getMock();

        $this->assertTrue($regionMock instanceof RegionInterface);
    }

    /**
     * Test __constrcut method.
     */
    public function testConstructor()
    {
        $regionMock = new class (110000) extends Region {
            public function getConstructorSetCode() {
                return $this->code;
            }
        };
        
        $this->assertEquals('110000', $regionMock->getConstructorSetCode());
    }

    /**
     * Test code method.
     */
    public function testCode()
    {
        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs(['110000'])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals(110000, $regionMock->code());
    }

    /**
     * Test province method
     */
    public function testProvince()
    {
        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs(['110105'])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('北京市', $regionMock->province());
    }

    /**
     * Test city method.
     */
    public function testCity()
    {
        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs(['511304'])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('南充市', $regionMock->city());

        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs(['110105'])
            ->setMethods(null)
            ->getMock();
        $this->assertEmpty($regionMock->city());
    }

    /**
     * Test county method.
     */
    public function testCounty()
    {
        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs(['510116'])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('双流区', $regionMock->county());
    }

    /**
     * Test tree method.
     */
    public function testTree()
    {
        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs([510116])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals(['四川省', '成都市', '双流区'], $regionMock->tree());

        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs([110105])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals(['北京市', '朝阳区'], $regionMock->tree());
    }

    public function testTreeString()
    {
        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs([510116])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('四川省成都市双流区', $regionMock->treeString());

        $regionMock = $this->getMockBuilder(Region::class)
            ->setConstructorArgs([110105])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('北京市#朝阳区', $regionMock->treeString('#'));
    }
}
