<?php

namespace AppBundle\Repository;

use CNAMTS\PHPK\CoreBundle\Data\Repository;

/**
 * DdqQuestionnaireTpRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DdqQuestionnaireTpRepository extends \Doctrine\ORM\EntityRepository implements Repository
{
    public function liste()
    {
        $qb = $this->createQueryBuilder('a');
        return $qb;
    }

    public function findOneByAgentByCampagne($agent, $campagne)
    {
        $query = $this->_em->createQuery(
            'SELECT q FROM AppBundle:DdqQuestionnaireTp q '
            . 'JOIN q.idDdqCampagne c '
            . 'WHERE c.libelle = :campagne '
            . 'AND q.idAgent = :idAgent');
        $query->setParameter('campagne', $campagne);
        $query->setParameter('idAgent', $agent);
        return $query->getSingleResult();
    }

    public function findOneByAgentCommentaire($agent)
    {
        $query0 = $this->_em->createQuery(
            'SELECT MAX(c.idDdqCampagne) FROM AppBundle:DdqQuestionnaireTp c');
        $parameters = ($query0->getResult()[0][1]);
        dump($parameters);
        /*dump($agent);*/

        $query = $this->_em->createQuery(
            'SELECT q FROM AppBundle:DdqQuestionnaireTp q '
            . 'JOIN q.idDdqCampagne c '
            . 'WHERE c.id = :campagne '
            . 'AND q.idAgent = :idAgent');

        $query->setParameter('campagne', $parameters);
        $requete = $query;
        dump($requete);
        $query->setParameter('idAgent', $agent);
        $requete1 = $query;
        dump($requete1);
        $resultat = $query->getSingleResult();
        dump($resultat);
        return $resultat;


    }

    public function findByMesCampagnes(array $parameters)
    {
        $query = $this->_em->createQuery(
            'SELECT q FROM AppBundle:DdqQuestionnaireTp q '
            . 'JOIN q.idDdqCampagne c '
            . 'WHERE c.statut = \'nouvelle\' '
            . 'AND q.idAgent = :idAgent');
        $query->setParameter('idAgent', $parameters[0]);
        return $query->getResult();
    }

    public function findByMesCampagnesTerminees(array $parameters)
    {
        $query = $this->_em->createQuery(
            'SELECT q FROM AppBundle:DdqQuestionnaireTp q '
            . 'JOIN q.idDdqCampagne c '
            . 'WHERE c.statut = \'terminée\' '
            . 'AND q.idAgent = :idAgent');
        $query->setParameter('idAgent', $parameters[0]);
        return $query->getResult();
    }

    public function findByQuestionnairesRemplis(array $parameters)
    {
        $query = $this->_em->createQuery(
            'SELECT q FROM AppBundle:DdqQuestionnaireTp q '
            . 'JOIN q.idAgent a '
            . 'WHERE a.nomentabrege = :nomentabrege '
            . 'AND q.statut = \'modifiable\'');
        $query->setParameter('nomentabrege', $parameters[0]);
        return $query->getResult();
    }

    public function findByQuestionnairesRemplisN1(array $parameters)
    {
        $query = $this->_em->createQuery(
            'SELECT q FROM AppBundle:DdqQuestionnaireTp q '
            . 'JOIN q.idAgent a '
            . 'WHERE a.sigleent LIKE :sigleent '
            . 'AND q.statut = \'validé N+1\'');
        $query->setParameter('sigleent', $parameters[0] . '%');
        return $query->getResult();
    }

    public function countByNbTotal($idCampagne)
    {
        $query = $this->_em->createQuery(
            'SELECT COUNT(q) FROM AppBundle:DdqQuestionnaireTp q '
            . 'WHERE q.idDdqCampagne = :idCampagne');
        $query->setParameter('idCampagne', $idCampagne);
        return $query->getSingleScalarResult();
    }

    public function countByValid($idCampagne)
    {
        $query = $this->_em->createQuery(
            'SELECT COUNT(q) FROM AppBundle:DdqQuestionnaireTp q '
            . 'WHERE q.idDdqCampagne = :idCampagne '
            . 'AND q.statut = \'validé N+2\'');
        $query->setParameter('idCampagne', $idCampagne);
        return $query->getSingleScalarResult();
    }

    public function countByInvalid($idCampagne)
    {
        $query = $this->_em->createQuery(
            'SELECT COUNT(q) FROM AppBundle:DdqQuestionnaireTp q '
            . 'WHERE q.idDdqCampagne = :idCampagne '
            . 'AND q.statut = \'invalidé N+1\' '
            . 'OR q.statut = \'invalidé N+2\'');
        $query->setParameter('idCampagne', $idCampagne);
        return $query->getSingleScalarResult();
    }
}
