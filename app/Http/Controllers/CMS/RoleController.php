<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repository\Interface\IRoleRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RoleController extends Controller
{
    protected IRoleRepository $roleRepository;

    public function __construct
    (
        IRoleRepository $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function create(Request $request)
    {
        try {
            $input = $request->all();

            $role = $this->roleRepository->create($input);
            dd($role);
            return response()->json([
                'status_code' => $role,
            ], ResponseAlias::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $role = $this->roleRepository->delete($id);

            return response()->json([
                'status_code' => $role,
            ], ResponseAlias::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                'result' => false,
                'message' => $e->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}