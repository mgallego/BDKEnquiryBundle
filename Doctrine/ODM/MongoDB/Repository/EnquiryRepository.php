<?php

namespace Bodaclick\BDKEnquiryBundle\Doctrine\ORM\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Bodaclick\BDKEnquiryBundle\Entity\Enquiry;
use Bodaclick\BDKEnquiryBundle\Model\EnquiryRepositoryInterface;

/**
 * Enquiry repository
 */
class EnquiryRepository extends DocumentRepository implements EnquiryRepositoryInterface
{
    /**
     * Gets all the enquiries associated with an object
     *
     * @param mixed $object
     * @return array|bool|\Doctrine\MongoDB\ArrayIterator|\Doctrine\MongoDB\Cursor|\Doctrine\MongoDB\EagerCursor|int|mixed|\MongoCursor|null
     */
    public function getEnquiriesFor($object)
    {
        $qb=$this->createQueryBuilder('e')
            ->field('about.$id')->equals(new \MongoId($object->getId()));

        return $qb->getQuery()->execute();
    }
}