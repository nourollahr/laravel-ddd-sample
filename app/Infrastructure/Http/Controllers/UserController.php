<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\User\DTOs\RegisterUserDTO;
use App\Application\User\UseCases\RegisterUserUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly RegisterUserUseCase $useCase) {}

    public function store(Request $request): JsonResponse
    {
        $dto = new RegisterUserDTO(
            $request->name,
            $request->email,
            $request->password
        );

        $user = $this->useCase->execute($dto);

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }
}
