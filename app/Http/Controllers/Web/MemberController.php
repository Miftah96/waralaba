<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseHelper;
use Datatables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Member::get();

        return view('member.index', compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.form');
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
            return redirect()->route('member.index');
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
    public function show($id)
    {
        $query = Member::findOrFail($id);
        return view('member.show', compact('query'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $query = Member::findOrFail($id);
        $data = [
            'query' => Member::findOrFail($id),
            'id' => $id
        ];
        return view('member.form', compact('data'));
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
        DB::beginTransaction();

        try{
            $password = $request->password;
            $hashPassword = Hash::make($password);
            $member = Member::findOrFail($id);
            $member->fill($request->all());
            if (!empty($password)) {
                $member->password = $hashPassword;
            }
            $member->update();
            DB::commit();

            return redirect()->route('member.show', $id);
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
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('member.index');
    }

    public function getList()
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
