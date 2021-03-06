<div style="text-align: center;">
    <iframe name="shoutFrame" width="<{$block.iframe_width}>" src="<{$xoops_url}>/modules/shoutbox/shoutframe.php"
            height="<{$block.iframe_height}>" frameborder="<{$block.iframe_border}>" scrolling="auto"></iframe>
</div>
<{if $block.guests_may_post}><span style="color: #990000; ">*</span><{$block.shoutbox_anonymous}><{/if}>

<{if $block.shoutbox_access}>
    <form name="shoutform" action="<{$xoops_url}>/modules/shoutbox/shoutframe.php" method="post" style="this.style.margin=0px';" target="shoutFrame">
        <{securityToken}><{*//mb*}>
        <{if $block.show_smileybar}><{$block.shoutbox_smibar}><{/if}>
        <{if !$xoops_isuser && $block.guests_may_chname}>
            <br>
            <b><{$smarty.const._MB_SHOUTBOX_NICK}>:</b>
            <br>
            <input id="shoutnick" onFocus="shoutform.shoutnick.select();" type="text" name="uname" size="18"
                   maxlength="20" class="shttxt" value="<{$block.shoutbox_uname}>"/>
        <{/if}>
        <br><b><{$smarty.const._MB_SHOUTBOX_SHOUT_TITLE}>:</b><br>
        <{if $block.input_type}>
            <script type="text/javascript">
                function limitText(limitField) {
                    fldValue = limitField.value;
                    var limitNum = <{$block.text_maxchars}>;
                    var chars = limitNum - fldValue.length;
                    //alert (chars); // delete after testing
                    <{if $block.input_alerts}>
                    if (chars <= 0) {
                        alert("You are trying to enter more than the limit of " + limitNum + " characters! ");
                        fldValue = fldValue.substring(0, limitNum - 1);
                        window.document.shoutform.shoutfield.value = fldValue;
                    }
                    if (chars == 20) {
                        alert("You are approaching the limit of " + limitNum + " characters and have only 20 characters left! ")
                    }
                    <{else}>
                    if (chars <= 0) {
                        fldValue = fldValue.substring(0, limitNum - 1);
                        window.document.shoutform.shoutfield.value = fldValue;
                    }
                    <{/if}>
                }
            </script>
            <textarea id="shoutfield" name="message" rows="<{$block.textarea_rows}>" cols="<{$block.textarea_cols}>"
                      maxlength="<{$block.text_maxchars}>" onKeyDown="limitText(shoutfield);"
                      onKeyUp="limitText(shoutfield);"></textarea>
        <{else}>
            <input type="text" id="shoutfield" name="message" size="<{$block.text_linelength}>"
                   maxlength="<{$block.text_maxchars}>"/>
        <{/if}>
        <{if $block.captcha_caption}>
            <br>
            <b><{$block.captcha_caption}></b>
            <br>
            <{$block.captcha_render}>
        <{/if}>
        <br>
        <input type="submit" value="<{$smarty.const._MB_SHOUTBOX_SHOUT}>"/>
        <{if $xoops_isadmin}>            &nbsp;
            <input type="submit" name="clear" value="<{$smarty.const._MB_SHOUTBOX_CLEAR}>"
                   onClick="return(confirm('<{$smarty.const._MB_SHOUTBOX_CONFIRMDEL|escape:'quotes'}>'))"/>
        <{/if}>
        <br><br>
        <table width="100%" height="10px" cellpadding="0" cellspacing="0"
               style="border-top:  1px solid #8B898B; border-left: 1px solid #8B898B; border-right: 1px solid #000000; border-bottom: 1px solid #000000; padding-left: 2px; padding-right: 2px; font-size: xx-small;">
            <tr>
                <td valign="top" align="left" width="10%">
                    <form>
                        <input type="button" value="<{$smarty.const._MB_SHOUTBOX_REFRESH}>"
                               onClick="parent.shoutFrame.location='<{$xoops_url}>/modules/shoutbox/shoutframe.php'"/>
                    </form>
                </td>
                <{if $block.popup}>
                <td valign="top" align="left">
                    <form>
                        <input type="button" value="<{$smarty.const._MB_SHOUTBOX_POPUP}>"
                               onClick="openWithSelfMain('<{$xoops_url}>/modules/shoutbox/popup.php','<{$smarty.const._MB_SHOUTBOX_TITLE}>',<{$block.popup_width}>,<{$block.popup_height}>);"/>
                    </form>
                    <{/if}>
                </td>
                <{if $block.block_autorefresh}>
                    <td valign="top" align="right">
                        <b><{$smarty.const._MB_SHOUTBOX_AUTOREFRESH}></b>&nbsp;
                        <input id="shoutrefresh" type="checkbox" name="shoutrefresh" value="checkbox"
                               onchange="parent.shoutFrame.location.reload();"/>
                        <select id="refreshtime" name="refreshtime">
                            <option value="10000">10 s</option>
                            <option value="20000" selected="selected">20 s</option>
                            <option value="40000">40 s</option>
                            <option value="60000">60 s</option>
                            <option value="120000">2 m</option>
                            <option value="240000">4 m</option>
                            <option value="480000">8 m</option>
                        </select>
                    </td>
                <{/if}>
            </tr>
        </table>
        <table>
            <tr>
                <td align="right" colspan="3" id="blockfooter" style="font-size : xx-small;">Powered by <a
                            href="http://www.xuups.com" target="_blank">Xuups</a>
                </td>
            </tr>
        </table>
    </form>
<{/if}>
