<?php
namespace Blog\Model;

use InvalidArgumentException;
use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Hydrator\HydratorInterface;

class ZendDbSqlRepository implements PostRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    /**
     * @var AdapterInterface
     */

     private $db;
      /**
     * @var HydratorInterface
     */

     private $hydrator;
     /**
     * @var Post
     */

     private $postPrototype;

    /**
     * @param AdapterInterface $db
     */
    public function __construct($db, $hydrator,  $postPrototype)
    {
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->postPrototype = $postPrototype;
    }

    public function findAllPosts()
    {
    	$sql       = new Sql($this->db);
	    $select    = $sql->select('posts');
	    $statement = $sql->prepareStatementForSqlObject($select);
	    $result    = $statement->execute();

	    if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
	        return [];
	    }

	    $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
	    // initialize: Khoi tao colection
	    $resultSet->initialize($result);
	    return $resultSet;
    }

    /**
     * {@inheritDoc}
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function findPost($id)
    {
    	$sql       = new Sql($this->db);
	    $select    = $sql->select('posts');
	    $select->where(['id = ?' => $id]);

	    $statement = $sql->prepareStatementForSqlObject($select);
	    $result    = $statement->execute();

	    if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
	        throw new RuntimeException(sprintf(
	            'Failed retrieving blog post with identifier "%s"; unknown database error.',
	            $id
	        ));
	    }

	    $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
	    $resultSet->initialize($result);
	    $post = $resultSet->current();

	    if (! $post) {
	        throw new InvalidArgumentException(sprintf(
	            'Blog post with identifier "%s" not found.',
	            $id
	        ));
	    }

	    return $post;
    }
}