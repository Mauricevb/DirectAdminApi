PHP Direct Admin API
====================

This is a set of classes to communicate with Direct Admin (DA)
via the Direct Admin API to configurate some things in 
for your webserver without login in to Direct Admin itself.

With this library you can control your webserver in your own
environment, for example  your very own CMS.

How to use
=========

You can use the wrapper Directadmin class like this:

```php
$da = new DirectAdmin('da.example.com', 2222, 'login', 'pass', 'my.domain.com');
$bandwidth = $da->site->bandwidth();
```

You can also use the API classes individually,
see demo/example.php for more examples.	