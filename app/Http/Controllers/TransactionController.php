<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UpdateData;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // $message = $request->input('info');
        $message = 'trial';
        UpdateData::dispatch($message);
        return response()->json(['success' => true, 'message' => 'data updated']);
    }

    public function getdata()
    {
        $data = User::count();
        return $data;
    }

    public function storeuser(){
        DB::beginTransaction();
        $dateAndTime = Carbon::now()->format('Y-m-d H:i:s'); 

        DB::table('users')->insert(
            [
                'name'           => 'test',
                'email'           => Str::random(10).'@gmail.com',
                'email_verified_at'                         => null,
                'password'                        => 'test',
                'created_at'                        => $dateAndTime
            ]
        ); 
        DB::commit();
        UpdateData::dispatch('createddata');
        return response()->json(['success' => true, 'message' => 'data updated']);

    }
}

