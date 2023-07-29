<?php

namespace App\Factory;

use App\Entity\Income;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Income>
 *
 * @method        Income|Proxy                     create(array|callable $attributes = [])
 * @method static Income|Proxy                     createOne(array $attributes = [])
 * @method static Income|Proxy                     find(object|array|mixed $criteria)
 * @method static Income|Proxy                     findOrCreate(array $attributes)
 * @method static Income|Proxy                     first(string $sortedField = 'id')
 * @method static Income|Proxy                     last(string $sortedField = 'id')
 * @method static Income|Proxy                     random(array $attributes = [])
 * @method static Income|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Income[]|Proxy[]                 all()
 * @method static Income[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Income[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Income[]|Proxy[]                 findBy(array $attributes)
 * @method static Income[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Income[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class IncomeFactory extends ModelFactory
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
            'category' => IncomeCategoryFactory::new(),
            'name' => self::faker()->text(24),
            'amount' => self::faker()->randomFloat(2, 50, 7500),
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
            // ->afterInstantiate(function(Income $income): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Income::class;
    }
}
