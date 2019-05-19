<?php

function gravatar_url($email)
{
    $email = md5($email);

    return "https://gravatar.com/avatar/{$email}?".http_build_query([
        's' => '240',
        'd' => 'identicon',
    ]);
}

function markdown($text)
{
    return (new Parsedown())->text($text);
}

function isActive($path)
{
    return request()->is($path) ? 'underline' : 'hover:underline';
}
