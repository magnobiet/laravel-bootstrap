<?php

namespace App\Http\Controllers;

use App\Repositories\StateRepository;
use App\Validators\StateValidator;
use Illuminate\Http\Request;

/**
 * Class StatesController.
 *
 * @package namespace App\Http\Controllers;
 */
class StatesController extends Controller
{
    /**
     * @var StateRepository
     */
    protected $repository;

    /**
     * @var StateValidator
     */
    protected $validator;

    /**
     * StatesController constructor.
     *
     * @param StateRepository $repository
     * @param StateValidator  $validator
     */
    public function __construct(StateRepository $repository, StateValidator $validator)
    {

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
        $states = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $states,
            ]);

        }

        return view('page.states.index', compact('states', 'filter'));

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

        $state = $this->repository->with(['city'])->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $state,
            ]);

        }

        return view('page.states.show', compact('state'));

    }

}
