# MameForm 

MameForm is a simple contact form based on [Sliex][1], [Twig][2], [SwiftMailer4][3]

Silex is based on [Symfony2][1].

## Requirements

Silex works with PHP 5.3.2 or later.
And if your PHP is compiled with --enable-zend-multibyte, phar doesn't work well.
MameForm app include .htacees to deny users to access view and vendor files, so .htaccess is available on the server.

## Installation

get code from GitHub.

    git clone git://github.com/brtriver/MameForm.git ./MameForm
    cd ./MameForm
	git submodule init
	git submodule update

If you need, you have to change .htaccess file.

## Setting

You have to change the define in index.php.

    // define
    define("EMAIL_SUBJECT", 'Email from MameForm');
    define("EMAIL_ADDRESS_FROM", 'example@example.com');

If you can change the mail body, you have only to modify the mail.twig.

## Templates

You can use parameters below.

    {{ request.get('parameter_name') }} : get escaped request parameter
    {{ app.baseUrl }} : get base URL

## Customize

In this application, Logic is only written in index.php simply.
If you want to customize this, modify the index.php.
This is not the best way to build an application but reading sample code is the easiest way to lean Silex.

## License

MameForm is licensed under the MIT license.

[1]: http://silex-project.org/
[2]: http://www.twig-project.org/
[3]: http://swiftmailer.org/