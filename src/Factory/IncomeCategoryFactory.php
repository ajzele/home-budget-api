<?php

namespace App\Factory;

use App\Entity\IncomeCategory;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<IncomeCategory>
 *
 * @method        IncomeCategory|Proxy             create(array|callable $attributes = [])
 * @method static IncomeCategory|Proxy             createOne(array $attributes = [])
 * @method static IncomeCategory|Proxy             find(object|array|mixed $criteria)
 * @method static IncomeCategory|Proxy             findOrCreate(array $attributes)
 * @method static IncomeCategory|Proxy             first(string $sortedField = 'id')
 * @method static IncomeCategory|Proxy             last(string $sortedField = 'id')
 * @method static IncomeCategory|Proxy             random(array $attributes = [])
 * @method static IncomeCategory|Proxy             randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static IncomeCategory[]|Proxy[]         all()
 * @method static IncomeCategory[]|Proxy[]         createMany(int $number, array|callable $attributes = [])
 * @method static IncomeCategory[]|Proxy[]         createSequence(iterable|callable $sequence)
 * @method static IncomeCategory[]|Proxy[]         findBy(array $attributes)
 * @method static IncomeCategory[]|Proxy[]         randomRange(int $min, int $max, array $attributes = [])
 * @method static IncomeCategory[]|Proxy[]         randomSet(int $number, array $attributes = [])
 */
final class IncomeCategoryFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $time = self::faker()->dateTimeBetween('-1 years', 'now');

        return [
            'owner' => UserFactory::new(),
            'name' => self::faker()->text(255),
            'createdAt' => $time,
            'updatedAt' => $time,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(IncomeCategory $incomeCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return IncomeCategory::class;
    }
}
