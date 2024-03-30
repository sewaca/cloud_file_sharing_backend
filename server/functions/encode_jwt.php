<?php
use \Firebase\JWT\JWT;

/**
 * Encodes a JWT token for the given user ID.
 *
 * @param int $user_id The ID of the user.
 * @throws Exception If there is an error encoding the token.
 * @return string The encoded JWT token.
 */
function encode_jwt($user_email){
  // TODO:? Возможно стоит добавить user_id 

  $token = array(
    "iss" => JWT_ISS,
    "aud" => JWT_AUD,
    "iat" => time(),
    "data" => $user_email,
  );
  $jwt = JWT::encode($token, JWT_SECRET, JWT_ALG);
  
  return $jwt;
}
