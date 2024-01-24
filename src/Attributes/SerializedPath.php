<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Attributes;

use Attribute;
use Symfony\Component\PropertyAccess\Exception\InvalidPropertyPathException;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Serializer\Attribute\SerializedPath as BaseSerializedPath;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class SerializedPath extends BaseSerializedPath
{
    private static ?string $mode = null;

    /** @var array<string, PropertyPath> */
    private array $serializedPaths = [];

    /**
     * @param array<string, string> $serializedPaths
     */
    public function __construct(string $serializedPath, array $serializedPaths = [])
    {
        parent::__construct($serializedPath);

        try {
            foreach ($serializedPaths as $mode => $serializedPath) {
                $this->serializedPaths[$mode] = new PropertyPath($serializedPath);
            }
        } catch (InvalidPropertyPathException) {
            throw new InvalidArgumentException(sprintf('Parameter given to "%s" must be a valid property path.', self::class));
        }
    }

    public function getSerializedPath(): PropertyPath
    {
        return self::$mode
            ? $this->serializedPaths[self::$mode]
            : parent::getSerializedPath();
    }

    public static function setMode(?string $mode): void
    {
        self::$mode = $mode;
    }

    public static function getMode(): ?string
    {
        return self::$mode;
    }
}
