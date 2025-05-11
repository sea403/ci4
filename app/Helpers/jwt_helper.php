<?php 


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Generate a jwt token
 * @param mixed $user
 * @return string
 */
function generateJWT($user)
{
    $key = getenv('JWT_SECRET');
    $payload = [
        'iss'   => 'ci4-jwt-api',
        'sub'   => $user['id'],
        'email' => $user['email'],
        'iat'   => time(),
        'exp'   => time() + 3600,
    ];

    return JWT::encode($payload, $key, 'HS256');
}

/**
 * Validate a token and get the decoded object
 * @param mixed $token
 * @return stdClass
 */
function validateJWT($token)
{
    return JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
}
