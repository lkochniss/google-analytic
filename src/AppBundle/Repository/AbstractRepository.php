<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractModel;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{

    /**
     * @param AbstractModel $entity Persists entity.
     * @return JsonResponse
     */
    public function save(AbstractModel $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }

    /**
     * @param AbstractModel $entity Delete entity.
     * @return JsonResponse
     */
    public function delete(AbstractModel $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
