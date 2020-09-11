<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Carbon\Carbon;
use App\Models\Model;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::with('model','customer','admin')->orderBy('happened_at', 'DESC')->get();
        return view('admin.transactions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return view('admin.transactions.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'happened_at' => 'required',
            'transaction_type_id' => 'required',
            'model_id' => 'required',
            'amount' => 'required|numeric',
        ];

        if($request->this_transaction_type == 1) $rules['customer_id'] = 'required';
        $this->validate($request, $rules);

        $data['uuid'] = $this->generate_uuid($request->this_transaction_type);
        $data['happened_at'] = Carbon::parse($request->happened_at);
        $data['transaction_type_id'] = $request->transaction_type_id;
        $data['model_id'] = $request->model_id;
        $data['amount'] = $request->amount;
        $data['note'] = ($request->note || $request->note != '') ? $request->note:null;
        $data['admin_id'] = Auth::guard('admin')->user()->id;
        
        if($request->this_transaction_type ==1) {
            $data['customer_id'] = $request->customer_id;
            $data['invoice'] = $request->invoice ? 1:0;
            $data['vat'] = ($data['invoice'] == 1) ? (floatval($data['amount']) * (7/100)) : 0;
            $data['tax'] = ($data['invoice'] == 1) ? (floatval($data['amount']) * (5/100)) : 0;
            
            $model = Model::with('agency')->where('id',$data['model_id'])->first();

            if($model->agency_id) {
                $data['agency_id'] = $model->agency_id;
                $data['agency_share'] = $model->agency->share;
                $data['agency_amount'] = floatval($data['amount']) * (intval($data['agency_share'])/100);
                $data['company_amount'] = floatval($data['amount']) - floatval($data['tax']) - floatval($data['agency_amount']);
            }
            
            $data['model_share'] = $model->mdoel_share;
            $data['model_amount'] = floatval($data['amount']) * (intval($data['model_share'])/100);

        }

        $transaction = Transaction::create($data);

        return redirect()->route('transactions.index')->withMessage('Transaction successfully stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaction::find($id);
        $type = $data->transaction_type_id;
        return view('admin.transactions.show', compact('data', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaction::find($id);
        $type = $data->transaction_type_id;
        return view('admin.transactions.edit', compact('data', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'happened_at' => 'required',
            'transaction_type_id' => 'required',
            'model_id' => 'required',
            'amount' => 'required|numeric',
        ];

        if($request->this_transaction_type == 1) $rules['customer_id'] = 'required';
        $this->validate($request, $rules);

        $data['happened_at'] = Carbon::parse($request->happened_at);
        $data['transaction_type_id'] = $request->transaction_type_id;
        $data['model_id'] = $request->model_id;
        $data['amount'] = $request->amount;
        $data['note'] = ($request->note || $request->note != '') ? $request->note:null;
        $data['admin_id'] = Auth::guard('admin')->user()->id;
        
        if($request->this_transaction_type ==1) {
            $data['customer_id'] = $request->customer_id;
            $data['invoice'] = $request->invoice ? 1:0;
            $data['vat'] = ($data['invoice'] == 1) ? (floatval($data['amount']) * (7/100)) : 0;
            $data['tax'] = ($data['invoice'] == 1) ? (floatval($data['amount']) * (5/100)) : 0;
            
            $model = Model::with('agency')->where('id',$data['model_id'])->first();

            if($model->agency_id) {
                $data['agency_id'] = $model->agency_id;
                $data['agency_share'] = $model->agency->share;
                $data['agency_amount'] = floatval($data['amount']) * (intval($data['agency_share'])/100);
                $data['company_amount'] = floatval($data['amount']) - floatval($data['tax']) - floatval($data['agency_amount']);
            }
            
            $data['model_share'] = $model->model_share;
            $data['model_amount'] = floatval($data['amount']) * (intval($data['model_share'])/100);

        }

        $transaction = Transaction::find($id)->update($data);

        return redirect()->route('transactions.index')->withMessage('Transaction successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::destroy($id);
        return json_encode([
                'redirect' => route('transactions.index')
            ]);
    }

    private function generate_uuid($type)
    {
        $digits = 7;
        $uuid = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        if( Transaction::where('uuid', $uuid)->first() ) {
            return $this->generate_uuid();
        }

        $append='';
        if($type == 1) {
            $append = 'E';
        } elseif($type==2) {
            $append = 'B';
        } 
        
        return $append.$uuid;
    }
}
