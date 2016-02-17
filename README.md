# Email Obfuscate Field for Drupal 8

## Source

GitHub: https://www.github.com/WondrousLLC/obfuscate_email_field

## What Is This?

This is a template to override the field output ot the type email. To hide your emails from bots, render a non readable
email on the server and decrypt it via vanilla JS in the client. The [basic idea](http://www.grall.name/posts/1/antiSpam-emailAddressObfuscation.html)
consists of three parts:

- hide behind a data-attribute
- substitute the @-sign and dots (.) with /at/, /dot/, then
- shift everything via [rot13](https://en.wikipedia.org/wiki/ROT13)

## How To Use it

Have a look into ``template/field--email.html.twig`` to have a fully working example. This template will be used
when the module is enabled. No jQuery needed.

```
<a data-mail-to="znvy/ng/znvy/qbg/pbz">Email</a>
<a data-mail-to="znvy/ng/znvy/qbg/pbz" data-replace-inner="">Email</a>
```

will be converted to

```
<a href="mailto:mail@mail.com">Email</a>
<a href="mailto:mail@mail.com">mail@mail.com</a>
```
