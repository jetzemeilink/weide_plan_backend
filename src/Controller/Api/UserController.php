<?php

namespace App\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Application\Service\UserApplicationService;
use App\Type\Request\CreateUserRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    public function __construct(private UserApplicationService $userApplicationService)
    {
        
    }

    /**
     * @ParamConverter(name="RequestParamConverter", class="CreateUserRequest")
     */
    public function createUser(Request $request, CreateUserRequest $createUserRequest): Response
    {
        $this->userApplicationService->createUser($createUserRequest);

        return $this->json(null, 201);
    }

    // to avoid naming conflicts with the underlying getUser method this method is name differently
    public function getSingleUser(Request $request): Response
    {
        $user = $this->userApplicationService->getUser($request->get('id'));
        
        return $this->json($user); 
    }
}
