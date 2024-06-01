<?php

namespace App\Controller;
use App\Entity\AuthRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\ORM\EntityManagerInterface;
use DateTime;
include "_pdo.php";

class AuthController extends AbstractController
{
    function insert_request($ip,$isvalid,EntityManagerInterface $em)
    {
       
    $newreq=new AuthRequest();
    $newreq->setIpaddress($ip);
    $newreq->setReqtime( new DateTime());
    //$newreq->se
    $em->persist($newreq);
    }

    #[Route('/auth', name: 'app_auth')]
    public function index(Request $request): JsonResponse
    {
       // if (!$this->isJsonRequest($request)) {
        //    throw new ServiceException('Bad Request Type');;
        //}
        $request=json_decode($request->getContent());
        $hashedkey=hash_pbkdf2('sha256',$request['x-apikey'],SALT,1100);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AuthController.php',
        ]);
    }
}
