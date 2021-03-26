<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
// ************ Requests ************
use Modules\Admin\Http\Requests\ProductSubTypeRequest;
// ************ Mails ************
// ************ Models ************
use App\ProductSubType;

class ProductsubtypeController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        $data = [];
        $data['id'] = $id = base64_decode($_GET['id']);
        if ($request->ajax()) {
            $data = ProductSubType::where('parent_id', '=', $_GET['id'])->get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('product-sub-type.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('product-sub-type.edit', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>';
                            })
                            ->editColumn('created_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->created_at));
                            })
                            ->editColumn('status', function($row) {
                                return ($row->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : '<span class="label label-sm label-success"> Active </span>';
                            })
                            ->rawColumns(['status', 'action'])
                            ->make(true);
        }
        return view('admin::productsubtype.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        $data = [];
        $data['id'] = $_GET['id'];
        return view('admin::productsubtype.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ProductSubTypeRequest $request) {
        $input = $request->all();
        $model = ProductSubType::create($input);
        $request->session()->flash('success', 'Product sub type created successfully.');
        return redirect()->route('product-sub-type.index', ['id' => base64_encode($model->parent_id)]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $id = base64_decode($id);
        $model = ProductSubType::findOrFail($id);
        return view('admin::productsubtype.view', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $id = base64_decode($id);
        $model = ProductSubType::findOrFail($id);
        return view('admin::productsubtype.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ProductSubTypeRequest $request, $id) {
        $input = $request->all();
        $id = base64_decode($id);
        $model = ProductSubType::findOrFail($id);
        $model->update($input);
        $request->session()->flash('success', 'Product type updated successfully.');
        return redirect()->route('product-sub-type.edit', ['id' => base64_encode($id)])->withInput();
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
