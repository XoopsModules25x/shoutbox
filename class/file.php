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
 */
// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

class ShoutboxFile extends XoopsObject
{
    /**
     * constructor
     */
    public function __construct()
    {
        $this->initVar('id', XOBJ_DTYPE_INT);
        $this->initVar('uid', XOBJ_DTYPE_INT);
        $this->initVar('uname', XOBJ_DTYPE_TXTBOX);
        $this->initVar('time', XOBJ_DTYPE_STIME);
        $this->initVar('ip', XOBJ_DTYPE_TXTBOX);
        $this->initVar('message', XOBJ_DTYPE_TXTAREA);

        $this->initVar('dohtml', XOBJ_DTYPE_INT, 0);
        $this->initVar('doxcode', XOBJ_DTYPE_INT, 0);
        $this->initVar('dosmiley', XOBJ_DTYPE_INT, 1);
        $this->initVar('doimage', XOBJ_DTYPE_INT, 1);
        $this->initVar('dobr', XOBJ_DTYPE_INT, 0);
    }

    /**
     * @param string $dateFormat
     * @param string $format
     * @return string
     */
    public function time($dateFormat = 's', $format = 'S')
    {
        return formatTimestamp($this->getVar('time', $format), $dateFormat);
    }
}

/**
 * Class ShoutboxFileHandler
 */
class ShoutboxFileHandler extends XoopsPersistableObjectHandler
{
    public $csvfile;

    /**
     * ShoutboxFileHandler constructor.
     * @param \XoopsDatabase $db
     */
    public function __construct(XoopsDatabase $db)
    {
        $this->csvfile = XOOPS_ROOT_PATH . '/uploads/shoutbox/shout.csv';
        parent::__construct($db, '', 'ShoutboxFile', 'id', 'uid');
    }

    /**
     * @return \XoopsObject
     */
    public function createShout()
    {
        return $this->create();
    }

    /**
     * @param $obj
     * @return bool
     */
    public function saveShout($obj)
    {
        $f = fopen($this->csvfile, 'a');
        fwrite($f, $obj->getVar('uname', 'n') . '|' . $obj->getVar('message', 'n') . '|' . $obj->getVar('time', 'n') . '|' . $obj->getVar('ip', 'n') . '|' . $obj->getVar('uid', 'n') . "\n");
        fclose($f);

        return true;
    }

    /**
     * @param $limit
     * @return array
     */
    public function getShouts($limit)
    {
        $objs   = array();
        $shouts = file($this->csvfile);
        $count  = count($shouts) - 1;
        $i      = 0;
        for ($count; $count >= 0; $count--) {
            if ($limit <= $i) {
                break;
            }
            $oneline = array();
            $oneline = explode('|', $shouts[$count]);

            $obj = $this->create();
            $obj->setVar('uname', $oneline[0]);
            $obj->setVar('message', $oneline[1]);
            $obj->setVar('time', $oneline[2]);
            $obj->setVar('ip', $oneline[3]);
            $obj->setVar('uid', $oneline[4]);
            $objs[] =& $obj;
            unset($obj);
            ++$i;
        }

        return $objs;
    }

    /**
     * @param $limit
     * @return bool
     */
    public function pruneShouts($limit)
    {
        $shouts = file($this->csvfile);
        $totrim = count($shouts) - $limit;
        if ($totrim > 0) {
            for ($i = 0; $i < $totrim; ++$i) {
                array_shift($shouts);
            }
            $f = fopen($this->csvfile, 'w');
            foreach ($shouts as $i => $line) {
                fwrite($f, $line);
            }
            fclose($f);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function deleteShouts()
    {
        $f = fopen($this->csvfile, 'w');
        fclose($f);

        return true;
    }

    /**
     * @param $message
     * @param $ip
     * @return bool
     */
    public function shoutExists($message, $ip)
    {
        $shouts = file($this->csvfile);
        if (!empty($shouts)) {
            $count   = count($shouts) - 1;
            $oneline = explode('|', $shouts[$count]);
            if (count($oneline) != 0) {
                if ($oneline[3] == $ip && $oneline[1] == $message) {
                    return true;
                }
            }
        }

        return false;
    }
}
