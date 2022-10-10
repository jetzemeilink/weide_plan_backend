<?php

use Symfony\Component\HttpFoundation\Request;
use App\Type\Request\CreateGuestRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GuestController extends AbstractController 
{

  public function __construct(private GuestApplicationService $guestApplicationService)
  {
    
  }

  public function createGuest(Request $request, CreateGuestRequest $createGuestRequest): Response
  {
    $guestView = $this->guestApplicationService->createGuest($createGuestRequest);

    return $this->json($guestView);
  }
}


