<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class DecryptController extends AbstractController
{
    #[Route(path: "/decr", methods: ["POST"])]
    public function decrypt_datafunc(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $cipher = $this->decryptData($data["cipher"], $data["key"]);
        if ($cipher==0){return new JsonResponse(["Error"=>"Failed to decrypt"],Response::HTTP_BAD_REQUEST);}
        return new JsonResponse(["KEY" => $data["key"], "decrypted" =>$cipher]);
    }

    private function decryptData($encryptedData, $key)
    {
        $encryptedData = base64_decode($encryptedData);
        $ivLength = openssl_cipher_iv_length('AES-256-CBC');
        $iv = substr($encryptedData, 0, $ivLength);
        $encryptedData = substr($encryptedData, $ivLength);
        return openssl_decrypt($encryptedData,'AES-256-CBC', $key, 0, $iv);
    }
}
