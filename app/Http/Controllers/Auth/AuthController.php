<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Auth\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Services\Users\UsersService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    private AuthServiceInterface $authService;
    private UsersService $usersService;

    /**
     * @param AuthServiceInterface $authService
     * @param UsersService $usersService
     */
    public function __construct(AuthServiceInterface $authService, UsersService $usersService){
        $this->authService = $authService;
        $this->usersService = $usersService;
    }


    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {

        $credentials = $request->only('email', 'password');
        $data = $this->authService->login($credentials);

        if (!$data) {
            return response()->json(
                ['error' => 'Invalid credentials'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse{
        if ($this->authService->logout()){
            return response()->json(['message' => 'Successfully logged out']);
        }
        return response()->json(
            ['error' => 'Ha ocurrido un error'],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );

    }

    /**
     * @param RefreshTokenRequest $request
     * @return JsonResponse
     */
    public function refresh(RefreshTokenRequest $request): JsonResponse{
        $new_token = $this->authService->refreshToken(
            $request->only('token')['token']
        );

        return response()->json($new_token);

    }

    public function me(): JsonResponse
    {
       $userData = $this->usersService->getAuthUser();
       return response()->json(
           ['user_data' => $userData],
       $userData
           ? Response::HTTP_OK
           : Response::HTTP_NOT_FOUND
       );
    }
}
