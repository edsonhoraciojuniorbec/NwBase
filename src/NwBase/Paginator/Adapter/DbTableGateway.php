<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace NwBase\Paginator\Adapter;

use Zend\Paginator\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\TableGateway\TableGateway;

/**
 * @category   Zend
 * @package    Zend_Paginator
 * @subpackage Adapter
 * @group      Zend_Paginator
 */
class DbTableGateway extends DbSelect
{
    /**
     * Construnct
     * 
     * @param TableGateway                $tableGateway
     * @param Where|\Closure|string|array $where
     */
    public function __construct(TableGateway $tableGateway, $where = null, $order = null)
    {
        $select = $tableGateway->getSql()->select();
        if ($where) {
            $select->where($where);
        }
        
        if ($order) {
            $select->order($order);
        }
        
        $dbAdapter          = $tableGateway->getAdapter();
        $resultSetPrototype = $tableGateway->getResultSetPrototype();
        
        parent::__construct($select, $dbAdapter, $resultSetPrototype);
    }
}