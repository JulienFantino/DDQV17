<?php

namespace AppBundle\Repository;
/**
 * DdqContratRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DdqContratRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByTempsPartielQueryBuilder($tempspartiel)
    {
        $query = $this->createQueryBuilder('a');
        $query->where('a.tempspartiel = :tempspartiel')
            ->setParameter('tempspartiel', $tempspartiel);
        return $query;
    }

    public function findByTempsPlein()
    {
        $query = $this->_em->createQuery(
            'SELECT c FROM AppBundle:DdqContrat c '
            . 'WHERE c.tempspartiel = false');
        return $query->getResult();
    }
}