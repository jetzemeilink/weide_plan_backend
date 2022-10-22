<?php

namespace App\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Application\Service\GuestApplicationService;
use Symfony\Component\HttpFoundation\Request;
use App\Type\Request\CreateGuestRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GuestController extends AbstractController 
{

  public function __construct(private GuestApplicationService $guestApplicationService)
  {
  }

      /**
     * @ParamConverter(name="RequestParamConverter", class="CreateGuestRequest")
     */
  public function createGuest(Request $request, CreateGuestRequest $createGuestRequest): Response
  {
    $guestView = $this->guestApplicationService->createGuest($createGuestRequest);

    return $this->json($guestView);
  }

  public function getGuest(Request $request): Response
  {
    $guest = $this->guestApplicationService->getGuest($request->get('id'));

    return $this->json($guest);
  }
}


