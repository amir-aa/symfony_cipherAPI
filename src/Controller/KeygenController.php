<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
//use Random\Engine\Secure;
class KeygenController extends AbstractController
{
    #[Route('/keygen', name: 'app_keygen',methods:['POST'])]
    public function index(Request $req): JsonResponse
    {
        $req=json_decode($req->getContent(), true);
        if (isset($req['tll'])) {$lifetime=floatval($req['tll']);}
        else {$lifetime=random_int(1,24);}//hours
       
        return $this->json([
            'Key' => bin2hex(random_bytes(32)),
            'Lifetime' => $lifetime*3600,
        ]);
    }
}
