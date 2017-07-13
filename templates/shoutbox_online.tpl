<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><{$smarty.const._MD_SHOUTBOX_POPUP_ONLINE}></title>
    <style type='text/css' media='all'>
        <!--
        @import url(<{$themecss}>);
        -->
    </style>
</head>
<body>
<table width="100%" cellspacing="1" class="outer" style="padding: 0; margin: 0;">
    <{foreach item=user from=$users}>
        <tr class='<{cycle values="odd,even"}>'>
            <{if $user.uid}>
                <td>
                    <a href="javascript:top.window.opener.location='<{$xoops_url}>/userinfo.php?uid=<{$user.uid}>';top.window.opener.focus();"><{$user.uname}></a>
                </td>
            <{/if}>
        </tr>
    <{/foreach}>
    <{if $anonymous_count gt 0}>
        <tr class='even'>
            <td>
                <{$anonymous_count}> <{$smarty.const._GUESTS}>
            </td>
        </tr>
    <{/if}>
    <tr class='foot'>
        <td>
            <a href="online.php"><{$smarty.const._MD_SHOUTBOX_POPUP_REFRESH}></a>
        </td>
    </tr>
    <{if $online_total gt 20}>
        <tr style='text-align: right;'>
            <td>
                <{$online_navigation}>
            </td>
        </tr>
    <{/if}>
</table>
