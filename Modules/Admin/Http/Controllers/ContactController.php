<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
// ************ Requests ************
use Modules\Admin\Http\Requests\ContactRequest;
// ************ Mails ************
use Modules\Admin\Emails\ContactReplyMail;
// ************ Models ************
use App\Contact;

class ContactController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Contact::get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('contact.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>';
                            })
                            ->editColumn('created_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->created_at));
                            })
                            ->editColumn('reply_status', function($row) {
                                return ($row->reply_status === '0') ? '<span class="label label-sm label-warning"> Not Replied </span>' : '<span class="label label-sm label-success"> Replied </span>';
                            })
                            ->rawColumns(['reply_status', 'action'])
                            ->make(true);
        }
        return view('admin::contact.index');
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
        $model = Contact::findOrFail($id);
        return view('admin::contact.view', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ContactRequest $request, $id) {
        $input = $request->all();
        $id = base64_decode($id);
        $model = Contact::findOrFail($id);
        $input['reply_status'] = '1';
        $model->update($input);
        Mail::to($model->email)->send(new ContactReplyMail($model));
        $request->session()->flash('success', 'Your message has been sucessfully sent to the user.');
        return redirect()->route('contact.show', ['id' => base64_encode($id)])->withInput();
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
