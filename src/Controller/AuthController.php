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
    /*function insert_request($ip,$isvalid,EntityManagerInterface $em)
    {
       
    $newreq=new AuthRequest();
    $newreq->setIpaddress($ip);
    $newreq->setReqtime( new DateTime());
    //$newreq->se
    $em->persist($newreq);
    }*/

    #[Route('/auth', name: 'app_auth', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $SALT1="3j4o@irj9frhjo!stZX5hgn34otj8ur5986nrgjkhlg5yQ";
       // if (!$this->isJsonRequest($request)) {
        //    throw new ServiceException('Bad Request Type');;
        //}
        $r = json_decode($request->getContent(), true); // Decode JSON as associative array

       
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['error' => 'Invalid JSON'], 400);
        }
    
        if (!isset($r['x-apikey'])) {
            return $this->json(['error' =>'Missing x-apikey'], 400);
        }
    
        $hashedkey=hash_pbkdf2('sha256',$r['x-apikey'],$SALT1,1100);
        $validity=false;
        
        $data=getkey($hashedkey);
        if (sizeof($data)>0){
            $now=time();
            $sinc=new DateTime($data[0]["created_time"]);
            $dif=abs($now-$sinc->getTimestamp());
            //echo $dif; to Tshoot
            $validity=$dif < ($data[0]["ttl"] *3600);
            if(! $validity ){ return $this->json(['is_valid' => $validity, 'Message' => "Expired Token", ],401);}
            return $this->json([
                'is_valid' => $validity,
                'Message' => "Key Valid",
            ]);
        }
        else{
        return $this->json([
            'is_valid' => $validity,
            'Message' => 'APIKEY Is not valid. this request will be tracked by SOC Team.',
        ],403);
            }
    }
}
