<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=<{$xoops_charset}>"/>
    <title><{$smarty.const._MD_SHOUTBOX_POPUP_TITLE}><{if $uname}><{$smarty.const._MD_SHOUTBOX_POPUP_CONNECTED}><{$uname}><{/if}></title>

    <style type='text/css' media='all'>
        <!--
        @import url(<{$themecss}>);
        -->
    </style>
    <{$xoops_js}>

</head>
<body>

<div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 70%; text-align: center;">
    <div style="position: relative; left: 0px; top: 0px; width: 100%; height: 100%; background: #CDF; text-align: center;">
        <div align="center" style="border:solid 1px #000000; width: 100%; height: 100%;" ;>
            <{$smarty.const._MD_SHOUTBOX_POPUP_MESSAGES}>
            <iframe class="frame1" name="shoutFrame" width="100%" height="100%" src="shoutpopupframe.php" frameborder="0"></iframe>
        </div>

        <div style="position: relative; left: 0px; top: 10px; text-align: center;">
            <{if $uname}>
            <{if $config.popup_whoisonline}>
            <div style="position: absolute; border:solid 1px #000000; left: 0px; width: 120px; text-align: center; background: #CDF;"><{$smarty.const._MD_SHOUTBOX_POPUP_ONLINE}>
                <div style="position: relative; left: 0px; width=120px; height=150px; text-align: center;">
                    <iframe class="frame2" name="onlineFrame" src="online.php" frameborder="0" width="120px"
                            height="150px"></iframe>
                </div>
            </div>
            <div style="position: absolute; border:solid 1px #000000; left: 130px; width: 300px; height: 150px; text-align: center; background: #CDF;" ;><{$smarty.const._MD_SHOUTBOX_POPUP_CONSOLE}>
                <{else}>
                <div style="position: absolute; border:solid 1px #000000; left: 130px; width: 300px; height: 150px; text-align: center; background: #CDF;"><{$smarty.const._MD_SHOUTBOX_POPUP_CONSOLE}>
                    <{/if}>
                    <div style="position: relative;left: 0px; width: auto; height: 150px; text-align: center;">


                        <form name="shoutform" method="post" action="shoutpopupframe.php" target="shoutFrame">
                            <{securityToken}><{*//mb*}>
                            <input type="hidden" name="uname" value="<{$uname}>"/>
                            <input type="hidden" name="uid" value="<{$uid}>"/>
                            <input type="hidden" value="1" name="didpost"/>
                            <script type="text/javascript">
                                <!--
                                document.write('<input type="text" class="text" id="shoutfield" name="message" size="18" maxlength="200" style="width: 200px; border: solid 1px #000000;"><input name="shoutsubmit" class="button" type="submit" value="<{$smarty.const._MD_SHOUTBOX_POPUP_SHOUT}>" style="width:40px; border: solid 1px #000000; margin-left: 5px;">');
                                //-->
                            </script>
                            <br>
                            <{if $config.popup_show_smileybar}>
                                <{$smiliesbar}>
                            <{/if}>
                            <{* REFRESH PART *}>
                            <br><span style="font-weight: bold;">
                                <{$smarty.const._MD_SHOUTBOX_POPUP_USE_AUTOREFRESH}>
                            </span>
                            <input id="shoutrefresh"
                                   type="checkbox"
                                   name="shoutrefresh"
                                   value="checkbox"
                                   checked='checked'
                                   onChange="top.shoutFrame.location.reload();"/>
                            | <span style="font-weight: bold;"><{$smarty.const._MD_SHOUTBOX_POPUP_REFRESHTIME}></span>
                            <select id="refreshtime" name="refreshtime">
                                <option value="5000">5 s</option>
                                <option value="10000">10 s</option>
                                <option value="20000" selected='selected'>20 s</option>
                                <option value="40000">40 s</option>
                                <option value="60000">60 s</option>
                                <option value="120000">2 m</option>
                                <option value="240000">4 m</option>
                                <option value="480000">8 m</option>
                            </select>
                            <br><span style="font-weight: bold;">
                                <{$smarty.const._MD_SHOUTBOX_POPUP_FORCE}>
                            </span>
                            <a href="shoutpopupframe.php"
                               target="shoutFrame"><{$smarty.const._MD_SHOUTBOX_POPUP_REFRESH}></a>

                            <{* Auto-focus part *}>
                            <{if $config.popup_autofocus}>
                                |
                                <span style="font-weight: bold;"><{$smarty.const._MD_SHOUTBOX_POPUP_AUTOFOCUS}></span>
                                <input id='autofocus' type='checkbox' class='checkbox' name='autofocus'
                                       value='autofocus' checked='checked'/>
                            <{/if}>
                            <{if $config.popup_sound}>
                                <br>
                                <span style="font-weight: bold;"><{$smarty.const._MD_SHOUTBOX_POPUP_SOUND_ON}></span>
                                <input id='soundselect' type='checkbox' class='checkbox' name='soundselect'
                                       value='soundselect' checked='checked'
                                       onChange="top.shoutFrame.location.reload();"/>
                            <{/if}>
                        </form>
                    </div>
                    <{else}>
                    <{if $config.popup_whoisonline}>
                    <div style="position: absolute; border:solid 1px #000000; left: 0px; width=120px; text-align: center; background: #CDF;"><{$smarty.const._MD_SHOUTBOX_POPUP_ONLINE}>
                        <div style="position: relative; left: 0px; bottom: float; width=120px; height=150px; text-align: center;">
                            <iframe class="frame2" name="onlineFrame" src="online.php" frameborder="0" width="120px"
                                    height="150px"></iframe>
                        </div>
                    </div>
                    <div style="position: absolute; border:solid 1px #000000; left: 130px; width=100%; height=150px; text-align: center;" ; background:#CDF;>
                        <{$smarty.const._MD_SHOUTBOX_POPUP_CONSOLE}>
                        <{else}>
                        <div style="position: absolute; border:solid 1px #000000; left: 130px; width=100%; height=150px; text-align: center;" ; background:#CDF;>
                            <{$smarty.const._MD_SHOUTBOX_POPUP_CONSOLE}>
                            <{/if}>
                            <div style="position: relative; left: 0px; height=150px; text-align: center;">
                                <form name="shoutform" method="post" action="popup.php">
                                    <{securityToken}><{*//mb*}>
                                    <br><span style="font-weight: bold;"><{$smarty.const._MD_SHOUTBOX_POPUP_ENTERNAME}> </span><br>
                                    <input type="text" id="shoutnick" name="uname" size="15" maxlength="12"
                                           onFocus="shoutform.shoutnick.select();" value="<{$uname}>"
                                           style="border: solid 1px #000000;"/>
                                    <input name="submit" type="submit"
                                           value="<{$smarty.const._MD_SHOUTBOX_POPUP_CONNECT}>"
                                           style="border: solid 1px #000000; margin-left: 5px;"/>
                                </form>
                                <{/if}>
                                <br><br><input value='<{$smarty.const._CLOSE}>' type='button'
                                               onclick='window.close();' style='border: solid 1px #000000;'/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>
