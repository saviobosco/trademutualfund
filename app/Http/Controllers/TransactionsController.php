<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Repository\UsersRepository;
class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::query()->with([
            'make_payment_user',
            'get_payment_user',
            'get_payment',
            'make_payment',
            'photo_proofs',
            'transaction_reports'
        ])->get();
        return view('transactions.index')->with(compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        if(request()->wantsJson()) {
            $transaction = Transaction::query()
                ->with([
                    'make_payment_user',
                    'get_payment_user',
                    'get_payment',
                    'make_payment',
                    'photo_proofs',
                    'transaction_reports'
                ])
                ->where('transactions.id', $transaction->id)
                ->first();
            return response()->json([
                'data' => $transaction
            ]);
        }
        return view('transactions.show')->with(compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function uploadProofOfPayment(Request $request,Transaction $transaction)
    {
        $this->validate($request,[
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('file');
        $input['photo_name'] = time().'.'.$image->getClientOriginalExtension();
        $input['photo_url'] = asset('storage/images') .'/'. $input['photo_name'];
        try {
            $image->storeAs('public/images', $input['photo_name']);
        } catch ( \Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ]);
        }
        $savedImage = $transaction->addImageProof($input);
        return response()->json([
            'data' => $savedImage
        ]);
    }

    public function removeProofOfPayment(Request $request, Transaction $transaction)
    {
        $transaction->removeImageProof($request->input('image_id'));
        return response()->json([
            'data' => 'Ok'
        ]);
    }

    public function active()
    {
        $transactions = UsersRepository::getUserActiveTransactions(auth()->user()->id);
        return response()->json([
            'data' => $transactions
        ]);
    }

    public function report(Request $request, Transaction $transaction)
    {
        $type = $request->input('type');
        $report = [
            'user_id' => auth()->user()->id,
        ];
        if ($type === 'fake_pop') {
            $report['type'] = $type;
        }
        $report = $transaction->reportFakeProofOfPayment($report);
        if ($report) {
            return response()->json([
                'data' => $report
            ]);
        }
    }

    public function confirm(Transaction $transaction)
    {
        if ($transaction->confirm()) {
            return response()->json([
                'data' => 'OK'
            ]);
        }
        return response()->json([
            'data' => 'Error'
        ]);
    }

    public function cancel(Transaction $transaction)
    {
        if ($transaction->cancel()) {
            return response()->json([
                'data' => 'OK'
            ]);
        }
        return response()->json([
            'data' => 'Error'
        ]);
    }
}
