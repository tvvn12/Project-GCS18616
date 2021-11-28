<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }
    public function viewuser($id)
    {
        $users = User::find($id);
        return view('admin.users.view',compact('users'));
    }
    public function s()
    {   
        $s = $_GET['s'];
        $danh =User::where('name','LIKE','%'.$s.'%')->orwhere('phone','LIKE','%'.$s.'%')->get();
       

        return view('admin.users.search',compact('danh'));
    }
    public function sorder()
    {   
        $s = $_GET['s'];
        $sorder =Order::where('tracking_no','LIKE','%'.$s.'%')->get();
        return view('admin.orders.search',compact('sorder'));
    }
    public function googlePieChart()
    {
        $data = DB::table('order_items')
            ->join('products', 'products.id', '=', 'order_items.pro_id')
            ->select('products.name', DB::raw('SUM(order_items.qty) as number'))
            ->groupBy('order_items.pro_id', 'products.name')
            ->orderBy('number', 'desc')
            ->get()->toArray();
        $array = [];
        foreach($data as $key => $value)
        {
          $array[] = [$value->name, $value->number];
        }
        // echo json_encode($array);die();
        // dd(json_encode(array_values($array)));
        return view('admin.index')->with('data', json_encode($array));
    }
}
