ixx-url-shortener
=================

A simple url shortener. demo: http://ixx.me

Works just fine with apache.
But with nginx need to add rewrite rule in config file:
	location / {
	    try_files $uri $uri/ /index.php$is_args$args;
	}
