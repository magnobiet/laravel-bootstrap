<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepository;
use App\Validators\CityValidator;
use Illuminate\Http\Request;

/**
 * Class CitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CitiesController extends Controller
{
    /**
     * @var CityRepository
     */
    protected $repository;

    /**
     * @var CityValidator
     */
    protected $validator;

    /**
     * CitiesController constructor.
     *
     * @param CityRepository $repository
     * @param CityValidator  $validator
     */
    public function __construct(CityRepository $repository, CityValidator $validator)
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
        $cities = $this->repository->with(['state'])->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cities,
            ]);
        }

        return view('page.cities.index', compact('cities', 'filter'));
    }

}
