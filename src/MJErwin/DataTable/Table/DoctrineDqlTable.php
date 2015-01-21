<?php


namespace MJErwin\DataTable\Table;

use Doctrine\ORM\Query;

/**
 * @author Matthew Erwin <matthew.j.erwin@me.com>
 * www.matthewerwin.co.uk
 */
class DoctrineDqlTable extends AbstractTable
{
    /** @var  Query */
    protected $query;

    /**
     * @return array
     */
    public function getData()
    {
        return $this->getQuery()->getArrayResult();
    }

    /**
     * @param Query $query
     *
     * @return $this
     */
    public function setQuery(Query $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

} 