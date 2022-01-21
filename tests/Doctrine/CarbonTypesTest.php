<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Doctrine;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\Doctrine\CarbonImmutableType;
use Carbon\Doctrine\CarbonType;
use Carbon\Doctrine\DateTimeDefaultPrecision;
use Carbon\Doctrine\DateTimeImmutableType;
use Carbon\Doctrine\DateTimeType;
use DateTimeImmutable;
use Doctrine\DBAL\Platforms\DB2Platform;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Exception;
use Generator;
use Tests\AbstractTestCase;

class CarbonTypesTest extends AbstractTestCase
{
    public static function setUpBeforeClass(): void
    {
        foreach (static::dataForTypes() as [$name, , $typeClass]) {
            Type::hasType($name)
                ? Type::overrideType($name, $typeClass)
                : Type::addType($name, $typeClass);
        }
    }

    public static function dataForTypes(): Generator
    {
        yield ['datetime', Carbon::class, DateTimeType::class, false];
        yield ['datetime_immutable', CarbonImmutable::class, DateTimeImmutableType::class, true];
        yield ['carbon', Carbon::class, CarbonType::class, true];
        yield ['carbon_immutable', CarbonImmutable::class, CarbonImmutableType::class, true];
    }

    /**
     * @group doctrine
     *
     * @param string $name
     *
     * @dataProvider \Tests\Doctrine\CarbonTypesTest::dataForTypes
     *
     * @throws Exception
     */
    public function testGetSQLDeclaration(string $name)
    {
        $type = Type::getType($name);

        $precision = DateTimeDefaultPrecision::get();
        $this->assertSame(6, $precision);

        $this->assertSame('DATETIME', $type->getSQLDeclaration([
            'precision' => null,
            'secondPrecision' => true,
        ], new MySQL57Platform()));

        $this->assertSame('DATETIME(3)', $type->getSQLDeclaration([
            'precision' => 3,
        ], new MySQL57Platform()));

        $this->assertSame('TIMESTAMP(0)', $type->getSQLDeclaration([
            'precision' => null,
            'secondPrecision' => true,
        ], new DB2Platform()));

        $this->assertSame('TIMESTAMP(6)', $type->getSQLDeclaration([
            'precision' => null,
        ], new DB2Platform()));

        $this->assertSame('TIMESTAMP(6)', $type->getSQLDeclaration([
            'precision' => 0,
        ], new DB2Platform()));

        $this->assertSame('DATETIME(6)', $type->getSQLDeclaration([
            'precision' => 0,
        ], new MySQL57Platform()));

        $this->assertSame('DATETIME(6)', $type->getSQLDeclaration([
            'precision' => null,
        ], new MySQL57Platform()));

        DateTimeDefaultPrecision::set(9);
        $this->assertSame('DATETIME(9)', $type->getSQLDeclaration([
            'precision' => null,
        ], new MySQL57Platform()));

        DateTimeDefaultPrecision::set(0);
        $this->assertSame('DATETIME', $type->getSQLDeclaration([
            'precision' => null,
        ], new MySQL57Platform()));

        DateTimeDefaultPrecision::set($precision);
    }

    /**
     * @group doctrine
     *
     * @param string $name
     * @param string $class
     *
     * @dataProvider \Tests\Doctrine\CarbonTypesTest::dataForTypes
     *
     * @throws Exception
     */
    public function testConvertToPHPValue(string $name, string $class)
    {
        $type = Type::getType($name);

        $this->assertNull($type->convertToPHPValue(null, new MySQL57Platform()));

        $date = $type->convertToPHPValue(Carbon::parse('2020-06-23 18:47'), new MySQL57Platform());
        $this->assertInstanceOf($class, $date);
        $this->assertSame('2020-06-23 18:47:00.000000', $date->format('Y-m-d H:i:s.u'));

        $date = $type->convertToPHPValue(new DateTimeImmutable('2020-06-23 18:47'), new MySQL57Platform());
        $this->assertInstanceOf($class, $date);
        $this->assertSame('2020-06-23 18:47:00.000000', $date->format('Y-m-d H:i:s.u'));

        $date = $type->convertToPHPValue('2020-06-23 18:47', new MySQL57Platform());
        $this->assertInstanceOf($class, $date);
        $this->assertSame('2020-06-23 18:47:00.000000', $date->format('Y-m-d H:i:s.u'));
    }

    /**
     * @group doctrine
     *
     * @param string $name
     * @param string $class
     *
     * @dataProvider \Tests\Doctrine\CarbonTypesTest::dataForTypes
     *
     * @throws Exception
     */
    public function testConvertToPHPValueFailure(string $name, string $class)
    {
        $this->expectExceptionObject(new ConversionException(
            "Could not convert database value \"2020-0776-23 18:47\" to Doctrine Type $name. ".
            "Expected format: Y-m-d H:i:s.u or any format supported by $class::parse()"
        ));

        Type::getType($name)->convertToPHPValue('2020-0776-23 18:47', new MySQL57Platform());
    }

    /**
     * @group doctrine
     *
     * @param string $name
     *
     * @dataProvider \Tests\Doctrine\CarbonTypesTest::dataForTypes
     *
     * @throws Exception
     */
    public function testConvertToDatabaseValue(string $name)
    {
        $type = Type::getType($name);

        $this->assertNull($type->convertToDatabaseValue(null, new MySQL57Platform()));
        $this->assertSame(
            '2020-06-23 18:47:00.000000',
            $type->convertToDatabaseValue(new DateTimeImmutable('2020-06-23 18:47'), new MySQL57Platform())
        );
    }

    /**
     * @group doctrine
     *
     * @param string $name
     *
     * @dataProvider \Tests\Doctrine\CarbonTypesTest::dataForTypes
     *
     * @throws Exception
     */
    public function testConvertToDatabaseValueFailure(string $name)
    {
        $quote = class_exists('Doctrine\\DBAL\\Version') ? "'" : '';
        $this->expectExceptionObject(new ConversionException(
            "Could not convert PHP value of type {$quote}array{$quote} to type {$quote}$name{$quote}. ".
            'Expected one of the following types: null, DateTime, Carbon'
        ));

        Type::getType($name)->convertToDatabaseValue([2020, 06, 23], new MySQL57Platform());
    }

    /**
     * @group doctrine
     *
     * @param string $name
     * @param string $class
     * @param string $typeClass
     * @param bool   $hintRequired
     *
     * @dataProvider \Tests\Doctrine\CarbonTypesTest::dataForTypes
     *
     * @throws Exception
     */
    public function testRequiresSQLCommentHint(string $name, string $class, string $typeClass, bool $hintRequired)
    {
        $type = Type::getType($name);

        $this->assertSame($hintRequired, $type->requiresSQLCommentHint(new MySQL57Platform()));
    }
}
