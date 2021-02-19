<?php

namespace App\Service;

use App\Utils\StringUtils;

class JWT
{
    // générer un JSON web Token
    public function generate(): String
    {
        /*
            étapes
                - encoder le header en base64URL
                - encoder le payload en base64URL
                - hacher le header et le payload et les assosier à a un secret
        */

        // header : configuration du JWT
        $header = [
            "alg" => "HS256",
            "typ"=> "JWT",
        ];
        $headerBase64 = StringUtils::base64url_encode(
            json_encode($header)
        );

        // playload (charge utile) : données 
        // iat :timestamp de la date ey l'heure de gégnération
        $playload = [
            "iat" => time(),
        ];
        $playloadBase64 = StringUtils::base64url_encode(
            json_encode($playload)
        );

        //créer une signature en utilisant la clé secret
        $signatureBase64 = StringUtils::base64url_encode(
            hash_hmac(
                'sha256',
                "$headerBase64.$playloadBase64",
                $_ENV['SECRET']
                )
            );

            // création du jeton
            $token = "$headerBase64.$playloadBase64.$signatureBase64";

            return $token;
    }

    // vérifier un token
    public function verify(String $token):bool
    {
        //séparer le header, du payload de la signature
        [ $headerBase64, $playloadBase64, $signature ] = explode('.', $token);

        // nouvelle signature
        $signatureBase64 = StringUtils::base64url_encode(
            hash_hmac(
                'sha256',
                "$headerBase64.$playloadBase64",
                $_ENV['SECRET']
                )
            );

            // vérification
            // tester si la nouvelle siganture est identique à la siganture contenue dans le token
            $signatureVerify = $signatureBase64 === $signature ? true : false;

            return $signatureVerify;

    }
}
