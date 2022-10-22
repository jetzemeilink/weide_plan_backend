<?php

namespace App\Controller\Api;

use App\Entity\Address;
use App\Repository\AddressRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Application\Service\AddressApplicationService;
use App\Type\Request\CreateAddressRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends AbstractController
{
  public function __construct(private AddressApplicationService $addressApplicationService)
  {
    
  }

  /**
   * @ParamConverter(name="RequestParamConverter", class="CreateAddressRequest")
   */
  public function createAddress(Request $request, CreateAddressRequest $createAddressRequest): Response
  {
    $address = $this->addressApplicationService->createAddress($createAddressRequest);

    return $this->json($address);
  }

  public function getAddress(Request $request): Response
  {
    $address = $this->addressApplicationService->getAddress($request->get('id'));

    return $this->json($address);
  }
}