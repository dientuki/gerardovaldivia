//Google analitic
	var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-23648336-1']);
	  _gaq.push(['_trackPageview']);
 
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
//My js
head.js(base_url + '/js/jquery-1.6.min.js',
		base_url + '/js/jquery.fancybox-1.3.4.pack.js',
		base_url + '/js/jquery.timers-1.2.js',
		base_url + '/js/jquery.easing.1.3.js',
		base_url + '/js/jquery.galleryview-3.0.min.js',
		base_url + '/js/script.js');

if (head.browser.ie)  {
	if (parseInt(head.browser.version) <= 6)   {
		head.js(base_url + '/js/dd_belatedpng.js', base_url +'/js/pngfix.js');
	}
}