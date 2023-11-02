<?php

declare(strict_types=1);

namespace TTBooking\WBEngine;

use Exception;
use ReflectionAttribute;
use ReflectionClass;
use TTBooking\WBEngine\DTO\Common\Request\Context;

trait QueryAttributes
{
    /**
     * @throws Exception
     */
    public function getEndpoint(): string
    {
        return self::attribute(Attributes\Endpoint::class)->endpoint
            ?? throw new Exception('Endpoint attribute not defined.');
    }

    /**
     * @throws Exception
     */
    public function getResultType(): string
    {
        return self::attribute(Attributes\ResultType::class)->type
            ?? throw new Exception('ResultType attribute not defined.');
    }

    public function withContext(Context $context): static
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @template TAttribute of object
     *
     * @param class-string<TAttribute> $attribute
     *
     * @return list<TAttribute>
     */
    private static function attributes(string $attribute, bool $ascend = false): array
    {
        $classRef = new ReflectionClass(static::class);
        $attrRefs = [];

        do {
            array_push($attrRefs, ...$classRef->getAttributes($attribute));
        } while ($ascend && false !== $classRef = $classRef->getParentClass());

        return array_map(static fn (ReflectionAttribute $attrRef) => $attrRef->newInstance(), $attrRefs);
    }

    /**
     * @template TAttribute of object
     *
     * @param class-string<TAttribute> $attribute
     *
     * @return null|TAttribute
     */
    private static function attribute(string $attribute, bool $ascend = false)
    {
        return self::attributes($attribute, $ascend)[0] ?? null;
    }
}
