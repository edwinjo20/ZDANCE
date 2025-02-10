<?php

namespace App\Repository;

use App\Entity\AdInscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AdInscription>
 */
class AdInscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdInscription::class);
    }

    /**
     * Retourne une liste des inscriptions correspondant à une valeur donnée
     * 
     * @param mixed $value
     * @return AdInscription[]
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouve une seule inscription correspondant à une valeur donnée
     * 
     * @param mixed $value
     * @return AdInscription|null
     */
    public function findOneBySomeField($value): ?AdInscription
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
