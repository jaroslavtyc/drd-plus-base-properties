<?php
declare(strict_types=1);

namespace DrdPlus\Tests\BaseProperties\EnumTypes;

use Doctrine\DBAL\Types\Type;
use Doctrineum\Scalar\ScalarEnumType;
use DrdPlus\Codes\Properties\PropertyCode;
use DrdPlus\BaseProperties\EnumTypes\BasePropertiesEnumRegistrar;
use Granam\Tests\Tools\TestWithMockery;

class BasePropertiesEnumRegistrarTest extends TestWithMockery
{

    /**
     * @throws \ReflectionException
     */
    protected function setUp(): void
    {
        $typeReflection = new \ReflectionClass(Type::class);
        $typesMap = $typeReflection->getProperty('_typesMap');
        $typesMap->setAccessible(true);
        $typesMap->setValue([]);

        $enumTypeReflection = new \ReflectionClass(ScalarEnumType::class);
        $subTypeMap = $enumTypeReflection->getProperty('enumSubTypesMap');
        $subTypeMap->setAccessible(true);
        $subTypeMap->setValue([]);
    }

    /**
     * @test
     * @throws \Doctrine\DBAL\DBALException
     */
    public function I_can_register_base_properties_as_doctrine_types(): void
    {
        BasePropertiesEnumRegistrar::registerAll();

        self::assertTrue(Type::hasType(PropertyCode::STRENGTH));
        self::assertTrue(Type::hasType(PropertyCode::AGILITY));
        self::assertTrue(Type::hasType(PropertyCode::KNACK));
        self::assertTrue(Type::hasType(PropertyCode::WILL));
        self::assertTrue(Type::hasType(PropertyCode::INTELLIGENCE));
        self::assertTrue(Type::hasType(PropertyCode::CHARISMA));
    }
}