<?php

declare(strict_types=1);

namespace TTBooking\WBEngine\Builders;

use Exception;
use ReflectionAttribute;
use ReflectionClass;
use TTBooking\WBEngine\Attributes;
use TTBooking\WBEngine\DTO\Common\Query\Context;
use TTBooking\WBEngine\ResultInterface;

/**
 * @template TResult of ResultInterface
 *
 * @property Context $context
 *
 * @method static static withContext(Context $context)
 */
trait Query
{
    use Buildable;

    public function withContext(Context $context): static
    {
        $this->context = $context;

        return $this;
    }

    public function getContext(): Context
    {
        return $this->context;
    }

    /**
     * @throws Exception
     */
    public static function getEndpoint(): string
    {
        return self::attribute(Attributes\Endpoint::class)->endpoint
            ?? throw new Exception('Endpoint attribute not defined.');
    }

    /**
     * @throws Exception
     */
    public static function getResultType(): string
    {
        /** @var class-string<TResult> */
        return self::attribute(Attributes\ResultType::class)->type
            ?? throw new Exception('ResultType attribute not defined.');
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
