<?php

namespace App\Controller;
use DateTime;
use App\Entity\APIkey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\Pbkdf2PasswordHasher;
define("SALT","3j4o@irj9frhjo!stZX5hgn34otj8ur5986nrgjkhlg5yQ");
//use Random\Engine\Secure;
class KeygenController extends AbstractController
{
    #[Route('/keygen', name: 'app_keygen',methods:['POST'])]
    public function index(Request $req,EntityManagerInterface $entityManager): JsonResponse
    {
        $req=json_decode($req->getContent(), true);
        if (isset($req['tll'])) {$lifetime=floatval($req['tll']);}
        else {$lifetime=random_int(1,24);}//hours
        $k=bin2hex(random_bytes(32));
        $now = new DateTime();
        $objAPIkey=new  APIkey();
        $objAPIkey->setApikey(hash_pbkdf2("sha256", $k,SALT,1100));
        $objAPIkey->setTtl($lifetime);
        $objAPIkey->setCreatedTime($now);
        $entityManager->persist($objAPIkey);
        $entityManager->flush();
        return $this->json([
            'Key' => $k,
            'Lifetime' => $lifetime*3600,
        ]);
    }
}
