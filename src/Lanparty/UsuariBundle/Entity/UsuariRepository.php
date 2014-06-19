<?php

namespace Lanparty\UsuariBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UsuariRepository extends EntityRepository
{
    public function findUsuari()
    {
        $em = $this->getEntityManager();
        
        $consulta = $em->createQuery('
            SELECT o.nom
            FROM UsuariBundle:Usuari o
            ');

        //$consulta->setParameter('nom', $nom);
        //$consulta->setParameter('cognoms', $cognoms);
        //$consulta->setMaxResults(1);
        
        //return $consulta->getSingleResult();
        return $consulta->getResult();
    }  
}