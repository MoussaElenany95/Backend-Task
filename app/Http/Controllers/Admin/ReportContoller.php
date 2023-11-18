<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\FilterTransactionRequest;
use App\Http\Resources\Admin\ReportResource;
use App\Support\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReportContoller extends Controller
{
    use ApiResponse;
    /**
     * Generate report  
     * @return JsonResponse
     */
    public function __invoke(FilterTransactionRequest $request): JsonResponse
    {
        $this->authorize('generate-report');

        $transactions = DB::table('transactions')
            ->leftJoin(DB::raw('(SELECT transaction_id, SUM(amount) as total_paid FROM payments GROUP BY transaction_id) as payments'), 'transactions.id', '=', 'payments.transaction_id')
            ->select(
                DB::raw('MONTH(transactions.created_at) as month'),
                DB::raw('YEAR(transactions.created_at) as year'),
                DB::raw('SUM(payments.total_paid) as paid'),
                DB::raw('SUM(CASE WHEN transactions.due_on > NOW() THEN (CASE WHEN transactions.is_vat_inclusive THEN transactions.amount + (transactions.amount*transactions.vat/100) ELSE transactions.amount END) - IFNULL(payments.total_paid, 0) ELSE 0 END) as outstanding'),
                DB::raw('SUM(CASE WHEN transactions.due_on <= NOW() THEN (CASE WHEN transactions.is_vat_inclusive THEN transactions.amount + (transactions.amount*transactions.vat/100) ELSE transactions.amount END) - IFNULL(payments.total_paid, 0) ELSE 0 END) as overdue')
            )
            ->when($request->start_date, fn ($query) => $query->whereDate('transactions.created_at', '>=', $request->start_date))
            ->when($request->end_date, fn ($query) => $query->whereDate('transactions.created_at', '<=', $request->end_date))
            ->groupBy('month', 'year')
            ->get();


        return $this->success('Report generated',ReportResource::collection($transactions));

    }
}
