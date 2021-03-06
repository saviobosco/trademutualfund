<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Repository\UsersRepository;
use Illuminate\Support\Facades\Storage;

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
        ])->latest('transactions.created_at')->orderBy('status')->paginate(30);
        return view('transactions.index')->with(compact('transactions'));
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
                    'make_payment_user:id,name',
                    'get_payment_user:id,name',
                    'photo_proofs',
                    'transaction_reports' => function($query) {
                        $query->where('status', 1);
                    }
                ])
                ->where('transactions.id', $transaction->id)
                ->first();
            return response()->json([
                'data' => $transaction
            ]);
        }
        return view('transactions.show')->with(compact('transaction'));
    }

    public function uploadProofOfPayment(Request $request,Transaction $transaction)
    {
        $this->validate($request,[
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('file');
        $input = null;
        $storage = null;
        $input['photo_name'] = time().'.'.$image->getClientOriginalExtension();
        $input['photo_url_part'] = 'storage/images';
        try {
            $env = env('FILESYSTEM_DRIVER');
            if ($env === 'local') {
                $input['photo_url'] = asset($input['photo_url_part']) .'/'. $input['photo_name'];
                $image->storeAs('public/images', $input['photo_name']);
            } elseif ($env === 'cloud') {
                $input['photo_url'] = env('AWS_URL').'/';
                $input['photo_url'] .= Storage::disk('s3')->putFileAs('/'.$input['photo_url_part'], $image,$input['photo_name'], 'public');
            }
        } catch ( \Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ]);
        }
        $savedImage = $transaction->addImageProof($input);
        $transaction->resetTimer();
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

    public function resolveIssue(Transaction $transaction)
    {
        if ($transaction->resolveReports()) {
            return response()->json([
                'data' => 'OK'
            ]);
        }
        return response()->json([
            'data' => 'Error'
        ],422);
    }

    public function resetTimer(Transaction $transaction)
    {
        if ($transaction->resetTimer()) {
            return response()->json([
                'data' => 'OK'
            ]);
        }
        return response()->json([
            'data' => 'Error'
        ],422);
    }
}
