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
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\DB2Platform;
use Doctrine\DBAL\Platforms\MySQL57Platform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Tests\AbstractTestCase;

class CarbonTypesTest extends AbstractTestCase
{
    public static function setUpBeforeClass(): void
    {
        foreach (static::getTypes() as [$name, , $typeClass]) {
            Type::hasType($name)
                ? Type::overrideType($name, $typeClass)
                : Type::addType($name, $typeClass);
        }
    }

    public static function getTypes()
    {
        return [
            ['datetime', Carbon::class, DateTimeType::class, false],
            ['datetime_immutable', CarbonImmutable::class, DateTimeImmutableType::class, true],
            ['carbon', Carbon::class, CarbonType::class, true],
            ['carbon_immutable', CarbonImmutable::class, CarbonImmutableType::class, true],
        ];
    }

    /**
     * @group doctrine
     *
     * @param string $name
     *
     * @dataProvider getTypes
     *
     * @throws DBALException
     */
    public function testGetSQLDeclaration(string $name)
    {
        $type = Type::getType($name);

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
     * @group doctrine
     *
     * @param string $name
     * @param string $class
     *
     * @dataProvider getTypes
     *
     * @throws DBALException
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
     * @dataProvider getTypes
     *
     * @throws ConversionException|DBALException
     */
    public function testConvertToPHPValueFailure(string $name, string $class)
    {
        $this->expectException(ConversionException::class);
        $this->expectExceptionMessage(
            "Could not convert database value \"2020-0776-23 18:47\" to Doctrine Type $name. ".
            "Expected format: Y-m-d H:i:s.u or any format supported by $class::parse()"
        );

        Type::getType($name)->convertToPHPValue('2020-0776-23 18:47', new MySQL57Platform());
    }

    /**
     * @group doctrine
     *
     * @param string $name
     *
     * @dataProvider getTypes
     *
     * @throws DBALException
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
     * @dataProvider getTypes
     *
     * @throws ConversionException|DBALException
     */
    public function testConvertToDatabaseValueFailure(string $name)
    {
        $this->expectException(ConversionException::class);
        $this->expectExceptionMessage(
            "Could not convert PHP value of type 'array' to type '$name'. ".
            'Expected one of the following types: null, DateTime, Carbon'
        );

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
     * @dataProvider getTypes
     *
     * @throws DBALException
     */
    public function testRequiresSQLCommentHint(string $name, string $class, string $typeClass, bool $hintRequired)
    {
        $type = Type::getType($name);

        $this->assertSame($hintRequired, $type->requiresSQLCommentHint(new MySQL57Platform()));
    }
}
