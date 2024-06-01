<?php

namespace App\Controller;

use App\Entity\APIkey;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
class GetkeysController extends AbstractController
{
    #[Route('/getkeys', name: 'app_getkeys')]
    
    public function index(EntityManagerInterface $aPIkey): JsonResponse
    {
        $apikeys = $aPIkey->getRepository(APIkey::class)->findAll();
        $data = [];
        foreach ($apikeys as $k) {
            $data[] = [
                'id' => $k->getId(),
                'TTL' => $k->getTtl(),
                'Key' => $k->getapikey(),
                'Created_at'=> $k->getCreatedTime(),
            ];
        }
        return $this->json($data);
    }

    #[Route('/getkeys/{key}', name: 'app_getkey')]
    
    public function getbyKey(EntityManagerInterface $aPIkey,$key): JsonResponse
    {
        $apikeys = $aPIkey->getRepository(APIkey::class)->findBy(['apikey'=>$key]);
        //echo $key;
        $data = [];
        foreach ($apikeys as $k) {
            $data[] = [
                'id' => $k->getId(),
                'TTL' => $k->getTtl(),
                'Key' => $k->getapikey(),
                'Created_at'=> $k->getCreatedTime(),
            ];
        }
        return $this->json($data);
    }
}
