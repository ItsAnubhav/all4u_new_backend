<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Orders\CreateOrderProductRequest;
use App\Http\Requests\Orders\UpdateOrderProductRequest;
use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class OrderProductAPIController
 */
class OrderProductAPIController extends AppBaseController
{
    private OrderProductRepository $orderProductRepository;

    public function __construct(OrderProductRepository $orderProductRepo)
    {
        $this->orderProductRepository = $orderProductRepo;
    }

    /**
     * Display a listing of the OrderProducts.
     * GET|HEAD /order-products
     */
    public function index(Request $request): JsonResponse
    {
        $orderProducts = $this->orderProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderProducts->toArray(), 'Order Products retrieved successfully');
    }

    /**
     * Store a newly created OrderProduct in storage.
     * POST /order-products
     */
    public function store(CreateOrderProductRequest $request): JsonResponse
    {
        $input = $request->all();

        $orderProduct = $this->orderProductRepository->create($input);

        return $this->sendResponse($orderProduct->toArray(), 'Order Product saved successfully');
    }

    /**
     * Display the specified OrderProduct.
     * GET|HEAD /order-products/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        return $this->sendResponse($orderProduct->toArray(), 'Order Product retrieved successfully');
    }

    /**
     * Update the specified OrderProduct in storage.
     * PUT/PATCH /order-products/{id}
     */
    public function update($id, UpdateOrderProductRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        $orderProduct = $this->orderProductRepository->update($input, $id);

        return $this->sendResponse($orderProduct->toArray(), 'OrderProduct updated successfully');
    }

    /**
     * Remove the specified OrderProduct from storage.
     * DELETE /order-products/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var OrderProduct $orderProduct */
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            return $this->sendError('Order Product not found');
        }

        $orderProduct->delete();

        return $this->sendSuccess('Order Product deleted successfully');
    }
}
