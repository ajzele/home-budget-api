<?php

namespace App\Doctrine;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Expense;
use App\Entity\ExpenseCategory;
use App\Entity\Income;
use App\Entity\IncomeCategory;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    /**
     * @todo refactor?!
     */
    public const OWNER_FILTERING_ENTITIES = [
        ExpenseCategory::class,
        Expense::class,
        IncomeCategory::class,
        Income::class
    ];

    public function __construct(private Security $security)
    {
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, Operation $operation = null, array $context = []): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        /**
         * @todo Works, but we could use some more logic???
         */
        if (\in_array($resourceClass, self::OWNER_FILTERING_ENTITIES)
            && $user = $this->security->getUser()) {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere(sprintf('%s.owner = :current_user', $rootAlias));
            $queryBuilder->setParameter('current_user', $user->getId());
        }

        return;
    }
}
