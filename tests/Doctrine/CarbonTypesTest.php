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
use Carbon\Doctrine\CarbonDoctrineType;
use Carbon\Doctrine\CarbonImmutableType;
use Carbon\Doctrine\CarbonType;
use Carbon\Doctrine\DateTimeDefaultPrecision;
use Carbon\Doctrine\DateTimeImmutableType;
use Carbon\Doctrine\DateTimeType;
use DateTimeImmutable;
use Doctrine\DBAL\Platforms\DB2Platform;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\DBAL\Types\ConversionException;
use Tests\AbstractTestCase;

class CarbonTypesTest extends AbstractTestCase
{
    public function getTypes()
    {
        return [
            ['datetime', Carbon::class, new DateTimeType()],
            ['datetime_immutable', CarbonImmutable::class, new DateTimeImmutableType()],
            ['carbon', Carbon::class, new CarbonType()],
            ['carbon_immutable', CarbonImmutable::class, new CarbonImmutableType()],
        ];
    }

    /**
     * @param string             $name
     * @param string             $class
     * @param CarbonDoctrineType $type
     *
     * @dataProvider getTypes
     */
    public function testGetSQLDeclaration(string $name, string $class, $type)
    {
        $precision = DateTimeDefaultPrecision::get();
        $this->assertSame(6, $precision);

        $this->assertSame('DATETIME(3)', $type->getSQLDeclaration([
            'precision' => 3,
        ], new MySQL57Platform()));

        $this->assertSame('TIMESTAMP(6)', $type->getSQLDeclaration([
            'precision' => null,
        ], new DB2Platform()));

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
     * @param string             $name
     * @param string             $class
     * @param CarbonDoctrineType $type
     *
     * @dataProvider getTypes
     */
    public function testConvertToPHPValue(string $name, string $class, $type)
    {
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
     * @param string             $name
     * @param string             $class
     * @param CarbonDoctrineType $type
     *
     * @dataProvider getTypes
     *
     * @throws ConversionException
     */
    public function testConvertToPHPValueFailure(string $name, string $class, $type)
    {
        $this->expectException(ConversionException::class);
        $this->expectExceptionMessage(
            "Could not convert database value \"2020-0776-23 18:47\" to Doctrine Type $name. ".
            "Expected format: Y-m-d H:i:s.u or any format supported by $class::parse()"
        );

        $type->convertToPHPValue('2020-0776-23 18:47', new MySQL57Platform());
    }

    /**
     * @param string             $name
     * @param string             $class
     * @param CarbonDoctrineType $type
     *
     * @dataProvider getTypes
     */
    public function testConvertToDatabaseValue(string $name, string $class, $type)
    {
        $this->assertNull($type->convertToDatabaseValue(null, new MySQL57Platform()));
        $this->assertSame(
            '2020-06-23 18:47:00.000000',
            $type->convertToDatabaseValue(new DateTimeImmutable('2020-06-23 18:47'), new MySQL57Platform())
        );
    }

    /**
     * @param string             $name
     * @param string             $class
     * @param CarbonDoctrineType $type
     *
     * @dataProvider getTypes
     *
     * @throws ConversionException
     */
    public function testConvertToDatabaseValueFailure(string $name, string $class, $type)
    {
        $this->expectException(ConversionException::class);
        $this->expectExceptionMessage(
            "Could not convert PHP value of type 'array' to type '$name'. ".
            'Expected one of the following types: null, DateTime, Carbon'
        );

        $type->convertToDatabaseValue([2020, 06, 23], new MySQL57Platform());
    }

    public function testRequiresSQLCommentHint()
    {
        $this->assertFalse((new DateTimeType())->requiresSQLCommentHint(new MySQL57Platform()));
        $this->assertTrue((new DateTimeImmutableType())->requiresSQLCommentHint(new MySQL57Platform()));
        $this->assertTrue((new CarbonType())->requiresSQLCommentHint(new MySQL57Platform()));
        $this->assertTrue((new CarbonImmutableType())->requiresSQLCommentHint(new MySQL57Platform()));
    }
}
