<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Validators\RoleValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class RolesController.
 *
 * @package namespace App\Http\Controllers;
 */
class RolesController extends Controller
{

    /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * @var RoleRepository
     */
    protected $permissionsRepository;

    /**
     * @var RoleValidator
     */
    protected $validator;

    /**
     * RolesController constructor.
     *
     * @param RoleRepository       $repository
     * @param PermissionRepository $permissionsRepository
     * @param RoleValidator        $validator
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissionsRepository, RoleValidator $validator)
    {

        $this->repository = $repository;
        $this->permissionsRepository = $permissionsRepository;
        $this->validator = $validator;

    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $filter = $request->input();
        $roles = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roles,
            ]);

        }

        return view('page.roles.index', compact('roles', 'filter'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permissionsList = $this->permissionsRepository->all();
        $permissions = [];

        foreach ($permissionsList as $permission) {
            $permissions[explode('.', $permission->name)[0]][] = $permission;
        }

        return view('page.roles.create', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(RoleCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $role = $this->repository->create($request->all());

            foreach ($request->only('permissions') as $key => $value) {

                $this->permissionsRepository->create([
                    'role_id'       => $role->id,
                    'permission_id' => $value->id,
                ]);

            }

            $response = [
                'message' => 'Role created.',
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);

            }

            return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag(),
                ]);

            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $role = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $role,
            ]);

        }

        return view('page.roles.show', compact('role'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = $this->repository->find($id);

        $permissionsList = $this->permissionsRepository->all();
        $permissions = [];

        foreach ($permissionsList as $permission) {
            $permissions[explode('.', $permission->name)[0]][] = $permission;
        }

        return view('page.roles.edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $role = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Role updated.',
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);

            }

            return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag(),
                ]);

            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Role deleted.',
                'deleted' => $deleted,
            ]);

        }

        return redirect()->back()->with('message', 'Role deleted.');

    }

}
