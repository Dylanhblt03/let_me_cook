<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findAllAuthors(): array
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT r.author')
            ->orderBy('r.author', 'ASC')
            ->getQuery()
            ->getSingleColumnResult()
        ;
    }

    public function findByFilters(?string $difficulte, ?string $duree, ?string $auteur): array
    {
        $recette = $this->createQueryBuilder('r');

        if ($difficulte) {
            $recette->andWhere('LOWER(r.difficulty) = :difficulte')
               ->setParameter('difficulte', strtolower($difficulte));
        }

        if ($duree) {
            if ($duree === '61') {
                $recette->andWhere('r.duration > 60');
            } else {
                $recette->andWhere('r.duration <= :duree')
                   ->setParameter('duree', (int) $duree);
            }
        }

        if ($auteur) {
            $recette->andWhere('r.author = :auteur')
               ->setParameter('auteur', $auteur);
        }

        return $recette->getQuery()->getResult();
    }
}
