<title>Shoutbox frame</title>
<{$xoops_js}>
<meta http-equiv="content-type" content="text/html; charset=<{$xoops_charset}>"/>
<{if $refresh}>
    <script language="javascript">
        <!--
        top.xoopsGetElementById("shoutfield").value = '';
        top.xoopsGetElementById("shoutfield").focus();
        //-->
    </script>
<{/if}>
<{if $config.popup_autofocus && $newmessage}>
    <script type="javascript">
        <!--
        if (top.xoopsGetElementById("autofocus").checked) {
            top.window.focus();
        }
        -->
    </script>
<{/if}>
<{$special_stuff_head}>
<script type="text/javascript">
    <!--
    var refreshtime = top.xoopsGetElementById("refreshtime").value;
    if (top.xoopsGetElementById("shoutrefresh").checked) {
        setTimeout('location.href="shoutpopupframe.php"', refreshtime);
    }
    -->
</script>

<script type="text/javascript">
    window.onload = function () {
        if (!document.getElementsByTagName) return;
        var anchors = document.getElementsByTagName("a");
        for (var count = 0; count < anchors.length; count++) {
            var anchor = anchors[count];
            if (anchor.getAttribute("href") && anchor.getAttribute("rel") == "external") {
                anchor.target = "_blank";
            }
        }
    }
</script>

<style type='text/css' media='all'>
    <!--
    @import url(<{$themecss}>);
    -->
</style>
