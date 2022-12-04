<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feature\Order;
use App\Models\Feature\OrderDetail;
use App\Models\Master\Product;
use App\Repositories\CrudRepositories;
use App\Services\Feature\OrderService;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;

class TransacationController extends Controller
{
    protected $orderService;
    protected $order;
    protected $orderDetail;
    protected $product;

    public function __construct(OrderService $orderService,Order $order, OrderDetail $orderDetail, Product $product)
    {
        $this->orderService = $orderService;
        $this->order = new CrudRepositories($order);
        $this->orderDetail = new CrudRepositories($orderDetail);
        $this->product = New CrudRepositories($product);
    }

    public function index()
    {
        $data['orders'] = $this->orderService->getUserOrder(auth()->user()->id);
        return view('frontend.transaction.index',compact('data'));
    }

    public function show($invoice_number)
    {
        $data['order'] = $this->order->Query()->where('invoice_number',$invoice_number)->first();
        $snapToken = $data['order']->snap_token;


//        dd($data['order']->invoice_number);
        if (empty($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database
            $midtrans = new CreateSnapTokenService($data['order']);
            $snapToken = $midtrans->getSnapToken();
            $data['order']->snap_token = $snapToken;
            $data['order']->save();
        }
        return view('frontend.transaction.show',compact('data'));
    }

    public function received($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 3]);
        return back()->with('success',__('message.order_received'));
    }

    public function settlement($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 1]);

        $order = $this->order->Query()->where('invoice_number', $invoice_number)->first();
        $orderDetail = $this->orderDetail->Query()->where('order_id', $order->id)->get();

        foreach ($orderDetail as $detail){
             $stok = $detail->Product->stok - $detail->qty;
             $this->product->Query()->where('id', $detail->product_id)->first()->update(['stok' => $stok]);
        }

        return back()->with('success',__('message.order_received'));

    }


    public function canceled($invoice_number)
    {
        $this->order->Query()->where('invoice_number',$invoice_number)->first()->update(['status' => 4]);
        return back()->with('success',__('message.order_canceled'));
    }
}
