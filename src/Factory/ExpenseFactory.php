<?php

namespace App\Factory;

use App\Entity\Expense;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Expense>
 *
 * @method        Expense|Proxy                    create(array|callable $attributes = [])
 * @method static Expense|Proxy                    createOne(array $attributes = [])
 * @method static Expense|Proxy                    find(object|array|mixed $criteria)
 * @method static Expense|Proxy                    findOrCreate(array $attributes)
 * @method static Expense|Proxy                    first(string $sortedField = 'id')
 * @method static Expense|Proxy                    last(string $sortedField = 'id')
 * @method static Expense|Proxy                    random(array $attributes = [])
 * @method static Expense|Proxy                    randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Expense[]|Proxy[]                all()
 * @method static Expense[]|Proxy[]                createMany(int $number, array|callable $attributes = [])
 * @method static Expense[]|Proxy[]                createSequence(iterable|callable $sequence)
 * @method static Expense[]|Proxy[]                findBy(array $attributes)
 * @method static Expense[]|Proxy[]                randomRange(int $min, int $max, array $attributes = [])
 * @method static Expense[]|Proxy[]                randomSet(int $number, array $attributes = [])
 */
final class ExpenseFactory extends ModelFactory
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
            'category' => ExpenseCategoryFactory::new(),
            'name' => self::faker()->text(24),
            'amount' => self::faker()->randomFloat(2, 10, 1000),
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
            // ->afterInstantiate(function(Expense $expense): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Expense::class;
    }
}
