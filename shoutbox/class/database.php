<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 *  Shoutbox class
 *
 * @copyright       The XUUPS Project http://sourceforge.net/projects/xuups/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         Shoutbox
 * @since           5.0
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: db.php 0 2010-01-06 18:47:04Z trabis $
 */

defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

class ShoutboxDatabase extends XoopsObject
{
    /**
     * constructor
     */
    function ShoutboxDatabase()
    {
        $this->initVar("id", XOBJ_DTYPE_INT);
        $this->initVar("uid", XOBJ_DTYPE_INT);
        $this->initVar("uname", XOBJ_DTYPE_TXTBOX);
        $this->initVar("time", XOBJ_DTYPE_STIME);
        $this->initVar("ip", XOBJ_DTYPE_TXTBOX);
        $this->initVar("message", XOBJ_DTYPE_TXTAREA);

        $this->initVar("dohtml", XOBJ_DTYPE_INT, 0);
        $this->initVar("doxcode", XOBJ_DTYPE_INT, 0);
        $this->initVar("dosmiley", XOBJ_DTYPE_INT, 1);
        $this->initVar("doimage", XOBJ_DTYPE_INT, 1);
        $this->initVar("dobr", XOBJ_DTYPE_INT, 0);
    }

    function time($dateFormat = 's', $format = 'S')
    {
        return formatTimestamp($this->getVar('time', $format), $dateFormat);
    }

}

class ShoutboxDatabaseHandler extends XoopsPersistableObjectHandler
{
    function ShoutboxDatabaseHandler(&$db)
    {
        $this->__construct($db);
    }

    function __construct($db)
    {
        parent::__construct($db, 'shoutbox', 'ShoutboxDatabase', 'id', 'uid');
    }

    function createShout()
    {
        return $this->create();
    }

    function saveShout($obj)
    {
        return $this->insert($obj);
    }

    function getShouts($limit)
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort('time');
        $criteria->setOrder('DESC');
        $criteria->setStart(0);
        $criteria->setLimit($limit);
        return $this->getObjects($criteria);
    }

    function pruneShouts($limit)
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setStart(0);
        $criteria->setLimit($limit);
        $objs = $this->getList($criteria, true);
        unset($criteria);
        $criteria = new Criteria('id', '(' . implode(',', array_keys($objs)) . ')', 'NOT IN');
        return $this->deleteAll($criteria);
    }

    function deleteShouts()
    {
        return $this->deleteAll();
    }

    function shoutExists($message, $ip)
    {
        $myts =& MyTextSanitizer::getInstance();
        $criteria = new CriteriaCompo(new Criteria('message', $myts->addSlashes($message)));
        $criteria->add(new Criteria('ip', $ip));
        return $this->getCount($criteria) ? true : false;
    }
}
?>