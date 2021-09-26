<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberCollection;
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Member::all();
        return ResponseHelper::response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $password = $request->password;
            $hashPassword = Hash::make($password);
            $member = new Member;
            $member->fill($request->all());
            $member->password = $hashPassword;
            $member->save();

            DB::commit();
            return ResponseHelper::response($member);
        }

        catch (\Throwable $th){
            DB::rollBack();
            return ResponseHelper::response($th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($member)
    {
        $member = Member::where('id', $member)->first();

        return ResponseHelper::response($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $member)
    {
        DB::beginTransaction();

        try{
            $password = $request->password;
            $hashPassword = Hash::make($password);
            $member = Member::findOrFail($member);
            $member->fill($request->all());
            $member->password = $hashPassword;
            $member->update();
            DB::commit();

            return ResponseHelper::response($member);
        } catch (\Throwable $th){
            DB::rollBack();

            return ResponseHelper::response($th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($member)
    {
        $member = Member::findOrFail($member);
        $member->delete();

        return ResponseHelper::response($member);
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
