<?php
namespace App\Repository\Type;

use App\DB\Connection;
use App\DB\QueryBuilder;
use App\Entity\Type\Status;
use App\Hydration\StatusHydrator;
use App\Repository\AbstractRepository;

class StatusRepository extends AbstractRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * StatusRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id):? Status
    {
        $entity = null;
        $sql = QueryBuilder::findOneBy('status');
        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $row = $statement->fetch();

        if($row) {
            $entity = StatusHydrator::hydrate($row);
        }
        return $entity;
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function findOneBy(array $options)
    {
        // TODO: Implement findOneBy() method.
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function findAllBy(array $options)
    {
        // TODO: Implement findAllBy() method.
    }

    /**
     * @param Status $entity
     * @return Status
     */
    public function save(Status $entity) {

        $data = [
            'name' => $entity->getName(),
            'internal_name' => $entity->getInternalName(),
        ];
        $table = 'status';
        $where = [];
        if (null !== $entity->getId()) {
            $where['id'] = $entity->getId();
        }
        $sql = QueryBuilder::insertOrUpdate($data, $table, $where);

        if (null !== $entity->getId()) {
            $data['id'] = $entity->getId();
        }

        $dbCon = $this->connection->open();

        $statement = $dbCon->prepare($sql);
        $statement->execute(array_values($data));

        if (null === $entity->getId()) {
            $entity->setId($dbCon->lastInsertId());
        }

        return $entity;
    }

}