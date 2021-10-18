<?php

declare(strict_types=1);

/*
 * This file is part of the Enumer package.
 *
 * (c) MarfaTech <https://marfa-tech.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MarfaTech\Component\Enumer;

use MarfaTech\Component\Enumer\Exception\EnumNotRegisteredException;
use ReflectionClass;
use ReflectionException;

use function array_change_key_case;
use function array_combine;
use function sprintf;

class EnumRegistry
{
    public const TYPE_ORIGINAL = 'Original';
    public const TYPE_COMBINE = 'Combine';
    public const TYPE_COMBINE_NORMALIZE = 'CombineNormalize';

    /**
     * @var array[]
     */
    private $enumList;

    /**
     * @param string $enumClass
     *
     * @throws ReflectionException
     */
    public function addEnum(string $enumClass): void
    {
        $constantOriginalList = $this->getConstantList($enumClass);
        $constantCombineList = array_combine($constantOriginalList, $constantOriginalList);
        $constantCombineNormalizeList = array_change_key_case($constantCombineList, CASE_LOWER);

        $this->enumList[$enumClass] = [
            self::TYPE_ORIGINAL => $constantOriginalList,
            self::TYPE_COMBINE => $constantCombineList,
            self::TYPE_COMBINE_NORMALIZE => $constantCombineNormalizeList,
        ];
    }

    /**
     * @param string $enumClass
     * @param string $type
     *
     * @return array
     */
    public function getEnum(string $enumClass, string $type): array
    {
        $enum = $this->enumList[$enumClass][$type] ?? null;

        if ($enum === null) {
            throw new EnumNotRegisteredException(sprintf('Enum type "%s" not registered.', $enumClass));
        }

        return $enum;
    }

    /**
     * @param string $enumClass
     *
     * @return array
     *
     * @throws ReflectionException
     */
    private function getConstantList(string $enumClass): array
    {
        $class = new ReflectionClass($enumClass);

        return $class->getConstants();
    }
}
