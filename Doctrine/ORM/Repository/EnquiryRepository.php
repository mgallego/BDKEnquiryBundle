<?php

/*
 * This file is part of the BDKEnquiryBundle package.
 *
 * (c) Bodaclick S.L. <http://bodaclick.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bodaclick\BDKEnquiryBundle\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityRepository;
use Bodaclick\BDKEnquiryBundle\Model\EnquiryRepositoryInterface;

/**
 * Enquiry repository
 */
class EnquiryRepository extends EntityRepository implements EnquiryRepositoryInterface
{

    /**
     * Gets all the enquiries associated with an object
     *
     * @param mixed $object
     * @return mixed
     */
    public function getEnquiriesFor($object)
    {
        //Generate the definition and find using the string generated
        $metadata = $this->getClassMetadata($object);
        $className = $metadata->getName();
        $ids = $metadata->getIdentifierValues($object);
        $definition = json_encode(compact("className", "ids"));

        $qb=$this->createQueryBuilder('e')
            ->where('about = :definition')
            ->setParameter('definition', $definition);


        return $qb->getQuery()->execute();
    }
}
