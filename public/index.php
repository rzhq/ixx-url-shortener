<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<SCRIPT type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></SCRIPT>

<script type="text/javascript">!window.jQuery && document.write('<SCRIPT language="javascript" src="<?php echo $this->url;?>/js/jquery.min.js"><\/SCRIPT>');</script>

<SCRIPT src="<?php echo $this->url;?>/js/main.js"></SCRIPT>

<link rel="stylesheet" type="text/css" href="<?php echo $this->url;?>/style.css" />

<meta name="keywords" content="ixx,短网址,缩短网址,url,shortener,网址缩短,短链接生成器,短链接" />

<meta name="description" content="ixx短地址是在线缩短网址服务，它可以将长链接生成短链接，缩短网址后，您就可以在微博、邮件中分享您的短网址了。缩短网址,更好分享。" />

<title>ixx - 短地址 Url Shortener</title>

</head>



<body>

	<div id="main">

    	<div id="logo"><b><a href="<?php echo _SITE_?>">ixx <b>短地址</b></a></b></div>

        <div id="content">

        	<div class="blank65"></div>

            <div id="input_frame"><input name="url" type="text" id="input" value="http://" /></div>

            <div id="hs">

          	  <div class="blank30"></div>

              <div id="short_frame"><input id="short" title="text" readonly="readonly" value="http://" /></div>

            </div>

            <div class="blank30"></div>

            <div id="button_frame"><button id="button">缩!</button></div>

        </div>

        <div id="bottom">©<a href="<?php echo _SITE_?>">ixx</a>.&nbsp;Powered by <a href="http://solidphp.org">solidphp</a>.&nbsp;Designed by <a href="http://aurorax.org">aurorax</a>.</div>
        
    </div>

</body>

</html>