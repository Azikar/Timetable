<?php

namespace App\Services;

use App\Interfaces\JwtInterface;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

class Jwt implements JwtInterface{

    protected $time;
    protected $signer;

    public function __construct(){
        $this->signer = new Sha256();
        $this->time = time();
    }
    public function createJwt($user){
        $token = (new Builder())->issuedBy('http://example.com') // Configures the issuer (iss claim)
                        ->permittedFor('http://example.org') // Configures the audience (aud claim)
                        ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                        ->issuedAt($this->time) // Configures the time that the token was issue (iat claim)
                        ->canOnlyBeUsedAfter($this->time + 60) // Configures the time that the token can be used (nbf claim)
                        ->expiresAt($this->time + 36000) // Configures the expiration time of the token (exp claim)
                        ->withClaim('uid', $user->id) // Configures a new claim, called "uid"
                        ->getToken($this->signer, new Key(env("JWT_KEY"))); // Retrieves the generated token
                        return 'Bearer:'.$token;
        }
    public function validateJwt($token){
        
        if($token!=null){
          
            $token=(new Parser())->parse((string) explode(':',$token)[1]);
            if($token->verify($this->signer, env("JWT_KEY"))&&$this->validateTime($token))
                return true;
            }
        return false;
    }
    public function validateTime($token){
        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer('http://example.com');
        $data->setAudience('http://example.org');
        $data->setId('4f1g23a12aa');
        $data->setCurrentTime($this->time + 61);
        if($token->validate($data))
            return true;
        else return false;

    }
    public function getPayload($token){
        if($token)
        $token=(new Parser())->parse((string) explode(':',$token)[1]);
        return $token->getClaim('uid');
    }
}