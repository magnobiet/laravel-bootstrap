<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator  $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {

        $this->middleware('auth');

        $this->repository = $repository;
        $this->validator = $validator;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $filter = $request->input();
        $users = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $users,
            ]);

        }

        return view('page.users.index', compact('users', 'filter'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('page.users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

                // TODO: migrate to a service
                \Cloudder::upload($request->file('photo'), null, [
                    "width"   => 512,
                    "height"  => 512,
                    "format"  => "png",
                    "gravity" => "face",
                    "crop"    => "thumb",
                ], [
                    "profile_image",
                ]);

                $photo = \Cloudder::getResult();
                $data['photo_url'] = $photo['secure_url'];

            }

            $user = $this->repository->create($data);

            $response = [
                'message' => 'User created.',
                'data'    => $user->toArray(),
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

        } catch (Exception $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage(),
                ]);

            }

            return redirect()->back()->withErrors($e->getMessage())->withInput();

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

        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);

        }

        return view('page.users.show', compact('user'));

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

        $user = $this->repository->find($id);

        return view('page.users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $data = $request->all();

            if (isset($data['password']) && $data['password']) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

                // TODO: migrate to a service
                \Cloudder::upload($request->file('photo'), null, [
                    "width"   => 512,
                    "height"  => 512,
                    "format"  => "png",
                    "gravity" => "face",
                    "crop"    => "thumb",
                ], [
                    "profile_image",
                ]);

                $photo = \Cloudder::getResult();
                $data['photo_url'] = $photo['secure_url'];

                $oldPhotoUrlFragments = explode('/', $request->old_photo);
                $photoPublicId = explode('.', end($oldPhotoUrlFragments))[0];

                \Cloudder::destroyImage($photoPublicId);
                \Cloudder::delete($photoPublicId);

            }

            $user = $this->repository->update($data, $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
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

        } catch (Exception $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage(),
                ]);

            }

            return redirect()->back()->withErrors($e->getMessage())->withInput();

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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);

        }

        return redirect()->back()->with('message', 'User deleted.');

    }

}
