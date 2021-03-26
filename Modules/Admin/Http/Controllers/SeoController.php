<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
// ************ Requests ************
use Modules\Admin\Http\Requests\SeoRequest;
// ************ Mails ************
// ************ Models ************
use App\Seo;

class SeoController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Seo::get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('seo.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('seo.edit', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>';
                            })
                            ->editColumn('', function($row) {
                                
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('admin::seo.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $id = base64_decode($id);
        $model = Seo::findOrFail($id);
        return view('admin::seo.view', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $id = base64_decode($id);
        $model = Seo::findOrFail($id);
        return view('admin::seo.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(SeoRequest $request, $id) {
        $input = $request->all();
        $id = base64_decode($id);
        $model = Seo::findOrFail($id);
        $model->update($input);
        $request->session()->flash('success', 'SEO updated successfully.');
        return redirect()->route('seo.edit', ['id' => base64_encode($id)])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
