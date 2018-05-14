<?php

namespace App\Http\Controllers;

use App\Repositories\AuditRepository;
use App\Validators\AuditValidator;

/**
 * Class AuditsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AuditsController extends Controller
{
    /**
     * @var AuditRepository
     */
    protected $repository;

    /**
     * @var AuditValidator
     */
    protected $validator;

    /**
     * AuditsController constructor.
     *
     * @param AuditRepository $repository
     * @param AuditValidator  $validator
     */
    public function __construct(AuditRepository $repository, AuditValidator $validator)
    {

        $this->repository = $repository;
        $this->validator = $validator;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $audits = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $audits,
            ]);

        }

        return view('page.audits.index', compact('audits'));

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

        $audit = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $audit,
            ]);

        }

        return view('page.audits.show', compact('audit'));

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
                'message' => 'Audit deleted.',
                'deleted' => $deleted,
            ]);

        }

        return redirect()->back()->with('message', 'Audit deleted.');

    }

}
