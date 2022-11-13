<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feature\Order;
use App\Repositories\CrudRepositories;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function order($id) {
        $year = date('Y');

        $data = DB::select("select * from orders where month(created_at) = $id and year(created_at) = $year");

        $pdf = PDF::loadView('backend.feature.order.laporan',[ 'data' => $data, 'bulan' => $id]);
        return $pdf->stream();
    }
}
