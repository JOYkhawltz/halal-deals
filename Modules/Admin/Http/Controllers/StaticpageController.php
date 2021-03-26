<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
// ************ Requests ************
use Modules\Admin\Http\Requests\StaticPageRequest;
// ************ Mails ************
// ************ Models ************
use App\StaticPage;

class StaticpageController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = StaticPage::get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('static-page.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('static-page.edit', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>';
                            })
                            ->editColumn('content', function($row) {
                                return (strlen($row->content) > 200) ? substr($row->content, 0, 200) . '...' : $row->content;
                            })
                            ->editColumn('updated_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->updated_at));
                            })
                            ->rawColumns(['content', 'action'])
                            ->make(true);
        }
        return view('admin::staticpage.index');
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
        $model = StaticPage::findOrFail($id);
        return view('admin::staticpage.view', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $id = base64_decode($id);
        $model = StaticPage::findOrFail($id);
        return view('admin::staticpage.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(StaticPageRequest $request, $id) {
        $input = $request->all();
        $id = base64_decode($id);
        $model = StaticPage::findOrFail($id);
        $model->update($input);
        $request->session()->flash('success', 'Content updated successfully.');
        return redirect()->route('static-page.edit', ['id' => base64_encode($id)])->withInput();
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
