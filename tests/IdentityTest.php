<?php

declare(strict_types=1);

namespace Medz\IdentityCard\China\Tests;

use Medz\IdentityCard\China\Identity;
use Medz\IdentityCard\China\IdentityInterface;
use Medz\IdentityCard\China\Region\RegionInterface;

class IdentityTest extends TestCase
{
    /**
     * Test Identity instance of IdentityInterface.
     */
    public function testInterface()
    {
        $identityMock = $this->createMock(Identity::class);

        $this->assertTrue($identityMock instanceof IdentityInterface);
    }

    /**
     * Test Identity legal method.
     */
    public function testLegal()
    {
        // Create the Mooc.
        $identityMock = $this->getMockBuilder(Identity::class)
            ->setConstructorArgs(['350301198906180060'])
            ->setMethods(['validateCheckCode'])
            ->getMock();

        // Set validateCheckCode method.
        $identityMock->expects($this->exactly(2))
            ->method('validateCheckCode')
            ->will($this->onConsecutiveCalls(true, false));
        
        $this->assertTrue($identityMock->legal());
        $this->assertFalse($identityMock->legal());
    }

    /**
     * Test Identity birthday method.
     */
    public function testBirthday()
    {
        $identityMock = $this->getMockBuilder(Identity::class)
            ->setConstructorArgs(['51100019921108'])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('1992-11-08', $identityMock->birthday());
    }

    /**
     * Test gender method.
     */
    public function testGender()
    {
        $identityMock = $this->getMockBuilder(Identity::class)
            ->setConstructorArgs(['0000000000000000100'])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('男', $identityMock->gender());

        $identityMock = $this->getMockBuilder(Identity::class)
            ->setConstructorArgs(['0000000000000000200'])
            ->setMethods(null)
            ->getMock();
        $this->assertEquals('女', $identityMock->gender());
    }

    /**
     * Test region method.
     */
    public function testRegion()
    {
        $identityMock = $this->getMockBuilder(Identity::class)
            ->setConstructorArgs(['1100000000000000200'])
            ->setMethods(null)
            ->getMock();
        $this->assertTrue($identityMock->region() instanceof RegionInterface);
    }
}
