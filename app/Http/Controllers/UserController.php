<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Exceptions\UserEmailAlreadyExistsException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function __construct(
        private UserService $service
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $users = $this->service->getAllUsers();
        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $dto = UserDTO::fromArray($request->validated());
            $user = $this->service->createUser($dto);

            return response()->json([
                'message' => 'Usuário criado com sucesso!',
                'data' => new UserResource($user),
            ], 201);
        } catch (UserEmailAlreadyExistsException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $user = $this->service->getUserById((int) $id);
            return response()->json(['data' => new UserResource($user)]);
        } catch (UserNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        try {
            $dto = UserDTO::fromArray($request->validated());
            $user = $this->service->updateUser((int) $id, $dto);

            return response()->json([
                'message' => 'Usuário atualizado com sucesso!',
                'data' => new UserResource($user),
            ]);
        } catch (UserNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (UserEmailAlreadyExistsException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->service->deleteUser((int) $id);
            return response()->json(['message' => 'Usuário deletado com sucesso!']);
        } catch (UserNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
