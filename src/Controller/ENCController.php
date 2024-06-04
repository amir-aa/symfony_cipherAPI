<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Utils\GlobalFunctions;

function IsValid($apikey){
    if(empty($apikey)){return false;}
    else{
return GlobalFunctions::is_key_valid($apikey);



    }
}

function encryptData($data, $key)
{
    $ivLength = openssl_cipher_iv_length('AES-256-CBC');
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encryptedData = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($iv . $encryptedData);
}

class ENCController extends AbstractController
{
    #[Route(path: "/enc", methods: ["POST"])]
    public function encryptionfunc(Request $request): JsonResponse
    {
        $headers = $request->headers->all();
        
        $data = json_decode($request->getContent(), true);
        $Plaintext = $data['plaintext'];
        $key = bin2hex(random_bytes(32));
        $cipher = encryptData($Plaintext, $key);
        $validity=IsValid($headers["x-apikey"][0]);
        if ($validity==1){       
            return new JsonResponse([
            "plaintext" => $Plaintext,
            "cipher" => $cipher,
            "key"=>(string)$key
        ]);
    }
    else if($validity==-1){return new JsonResponse(["Message"=>"Token Expired"],403);}
    return new JsonResponse(["Message"=>"Bad Request"],500);
    }
}
