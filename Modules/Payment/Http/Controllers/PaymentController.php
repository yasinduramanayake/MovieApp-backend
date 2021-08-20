<?php

namespace Modules\Payment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Http\Resources\PaymentResourceCollection;
use Modules\Payment\Http\Requests\AddPaymentRequest;
use Modules\Payment\Http\Requests\UpdatePaymentRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Modules\Payment\Http\Resources\PaymentResource;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except([
            'index',
            'store',
            'update',
            'destroy',
        ]);
    }
    /**
     *   * @return PaymentResourceCollection
     * @return ResponseFactory|Response
     */
    public function index()
    {
        return response()->json([
            'data' => PaymentResourceCollection::make(
                QueryBuilder::for(Payment::class)
                    ->defaultSort('-id')
                    ->allowedFilters(['name'])
                    ->allowedSorts(['name', 'cardnumber', 'cvv'])
                    ->paginate()
                    ->appends(request()->query())
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param AddPaymentRequest $request
     * @return ResponseFactory|Response
     */
    public function store(AddPaymentRequest $request)
    {
        $data = $request->validated();

        $paymentdata = Payment::create($data);

        return response([
            'data' => $paymentdata,
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('payment::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('payment::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePaymentRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdatePaymentRequest $request, Payment $id)
    {
        $data = $request->validated();
        $id->update($data);
        return response()->json(['data' => $id]);
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Payment $id)
    {
        return response()->json(['successfully deleted' => $id->delete()]);
    }
}