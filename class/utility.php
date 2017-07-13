<?php

/**
 * Class MyalbumUtil
 */
class ShoutboxUtility extends XoopsObject
{
    /**
     * Function responsible for checking if a directory exists, we can also write in and create an index.html file
     *
     * @param string $folder The full path of the directory to check
     *
     * @return void
     */
    public static function createFolder($folder)
    {
        //        try {
//            if (!mkdir($folder) && !is_dir($folder)) {
//                throw new \RuntimeException(sprintf('Unable to create the %s directory', $folder));
//            } else {
//                file_put_contents($folder . '/index.html', '<script>history.go(-1);</script>');
//            }
//        }
//        catch (Exception $e) {
//            echo 'Caught exception: ', $e->getMessage(), "\n", '<br/>';
//        }
        try {
            if (!file_exists($folder)) {
                if (!mkdir($folder) && !is_dir($folder)) {
                    throw new \RuntimeException(sprintf('Unable to create the %s directory', $folder));
                } else {
                    file_put_contents($folder . '/index.html', '<script>history.go(-1);</script>');
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n", '<br/>';
        }
    }

    /**
     * @param $file
     * @param $folder
     * @return bool
     */
    public static function copyFile($file, $folder)
    {
        return copy($file, $folder);
        //        try {
        //            if (!is_dir($folder)) {
        //                throw new \RuntimeException(sprintf('Unable to copy file as: %s ', $folder));
        //            } else {
        //                return copy($file, $folder);
        //            }
        //        } catch (Exception $e) {
        //            echo 'Caught exception: ', $e->getMessage(), "\n", "<br/>";
        //        }
        //        return false;
    }

    /**
     * @param $src
     * @param $dst
     */
    public static function recurseCopy($src, $dst)
    {
        $dir = opendir($src);
        //    @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file !== '.') && ($file !== '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     *
     * Verifies XOOPS version meets minimum requirements for this module
     * @static
     * @param XoopsModule $module
     *
     * @param null|string        $requiredVer
     * @return bool true if meets requirements, false if not
     */
    public static function checkVerXoops(XoopsModule $module = null, $requiredVer = null)
    {
        $moduleDirName = basename(dirname(__DIR__));
        if (null === $module) {
            $module        = XoopsModule::getByDirname($moduleDirName);
        }
        xoops_loadLanguage('admin', $moduleDirName);
        //check for minimum XOOPS version
        $currentVer = substr(XOOPS_VERSION, 6); // get the numeric part of string
        $currArray  = explode('.', $currentVer);
        if (null === $requiredVer) {
            $requiredVer = '' . $module->getInfo('min_xoops'); //making sure it's a string
        }
        $reqArray = explode('.', $requiredVer);
        $success  = true;
        foreach ($reqArray as $k => $v) {
            if (isset($currArray[$k])) {
                if ($currArray[$k] > $v) {
                    break;
                } elseif ($currArray[$k] == $v) {
                    continue;
                } else {
                    $success = false;
                    break;
                }
            } else {
                if ((int)$v > 0) { // handles things like x.x.x.0_RC2
                    $success = false;
                    break;
                }
            }
        }

        if (!$success) {
            $module->setErrors(sprintf(_AM_SHOUTBOX_ERROR_BAD_XOOPS, $requiredVer, $currentVer));
        }

        return $success;
    }

    /**
     *
     * Verifies PHP version meets minimum requirements for this module
     * @static
     * @param XoopsModule $module
     *
     * @return bool true if meets requirements, false if not
     */
    public static function checkVerPhp(XoopsModule $module)
    {
        xoops_loadLanguage('admin', $module->dirname());
        // check for minimum PHP version
        $success = true;
        $verNum  = PHP_VERSION;
        $reqVer  = $module->getInfo('min_php');
        if (false !== $reqVer && '' !== $reqVer) {
            if (version_compare($verNum, $reqVer, '<')) {
                $module->setErrors(sprintf(_AM_SHOUTBOX_ERROR_BAD_PHP, $reqVer, $verNum));
                $success = false;
            }
        }

        return $success;
    }



    public static function getOption($option, $dirname = 'shoutbox')
    {
        static $modOptions = array();
        if (is_array($modOptions) && array_key_exists($option, $modOptions)) {
            return $modOptions[$option];
        }

        $ret = null;
        /** @var XoopsModuleHandler $moduleHandler */
        $moduleHandler  = xoops_getHandler('module');
        $module         = $moduleHandler->getByDirname($dirname);
        $configHandler = xoops_getHandler('config');
        if ($module) {
            $moduleConfig = $configHandler->getConfigsByCat(0, $module->getVar('mid'));
            if (isset($moduleConfig[$option])) {
                $ret = $moduleConfig[$option];
            }
        }
        $modOptions[$option] = $ret;

        return $ret;
    }

    /**
     * @return string
     */
    public static function makeGuestName()
    {
        global $xoopsConfig;
        $ipadd     = getenv('REMOTE_ADDR');
        $iparr     = explode('.', $ipadd);
        $ipadd     = $iparr[0] + $iparr[1] + $iparr[2] + $iparr[3];
        $guestname = $xoopsConfig['anonymous'] . $ipadd;

        return $guestname;
    }

    /**
     * @param int $uid
     * @return string
     */
    public static function getUserName($uid = 0)
    {
        xoops_load('XoopsUserUtility');
        $uname = XoopsUserUtility::getUnameFromId($uid, static::getOption('user_realname'));

        return $uname;
    }

    /**
     * Most of these functions were written (originally)
     * by Florian Solcher <e-xoops.alphalogic.org>
     * @param $timestamp
     * @return bool
     */
    public static function setCookie($timestamp)
    {
        if (empty($_COOKIE['shoutcookie'])) {
            setcookie('shoutcookie', $timestamp);

            return false;
        }

        if ($_COOKIE['shoutcookie'] < $timestamp) {
            setcookie('shoutcookie', $timestamp);

            return true;
        } else {
            return false;
        }
    }

    //irc like commands
    /**
     * @param $command
     * @return bool
     */
    public static function ircLike($command)
    {
        global $xoopsModuleConfig, $xoopsUser, $special_stuff_head;
        if ($command === '/quit') {
            $special_stuff_head .= '<script language="javascript">';
            $special_stuff_head .= '    top.window.close();';
            $special_stuff_head .= '</script>';

            return true;
        }
        $commandlines = explode(' ', $command);
        if (is_array($commandlines)) {
            //general commands
            //unregistered commands
            if (!$xoopsUser) {
                if (count($commandlines) == 2) {
                    if (($commandlines[0] === '/nick') && ($commandlines[1] !== '')) {
                        if ($xoopsModuleConfig['guests_may_chname'] == 1) {
                            $special_stuff_head .= '<script language="javascript">';
                            $special_stuff_head .= '    top.document.location.href="popup.php?username=' . htmlentities($commandlines[1], ENT_QUOTES) . '";';
                            $special_stuff_head .= '</script>';

                            return true;
                        } else {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }
    
    
    
}
