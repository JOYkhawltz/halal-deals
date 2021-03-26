<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
// ************ Requests ************
// ************ Mails ************
// ************ Models ************
use App\Setting;

class SettingsController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        $data = [];
        if ($request->session()->has('selected_tab')) {
            $data['tab'] = $request->session()->get('selected_tab');
            $request->session()->forget('selected_tab');
        } else
            $data['tab'] = 0;
        $modules = [];
        $system_tab = array();

        $systems[] = array('title' => 'PHP Version', 'value' => phpversion() . '&nbsp&nbsp<a href="' . Route('admin-dashboard') . '" target="_blank">Complete PHP Info</a>');
        $systems[] = array('title' => 'MySQL Version', 'value' => Setting::mysql_version());
        foreach (Setting::get() as $mod) {
            $modules[$mod->module][] = (object) array(
                        'slug' => $mod->slug,
                        'title' => $mod->title,
                        'description' => $mod->description,
                        'type' => $mod->type,
                        'default' => $mod->default,
                        'value' => $mod->value,
                        'module' => $mod->module,
                        'options' => $mod->options,
            );
        }
        foreach ($systems as $system) {
            $system_tab[] = (object) array(
                        'slug' => isset($system['slug']) ? $system['slug'] : '',
                        'title' => isset($system['title']) ? $system['title'] : '',
                        'description' => isset($system['description']) ? $system['description'] : '',
                        'type' => isset($system['type']) ? $system['type'] : '',
                        'default' => isset($system['default']) ? $system['default'] : '',
                        'value' => isset($system['value']) ? $system['value'] : '',
                        'options' => isset($system['value']) ? $system['value'] : '',
                        'module' => 'System',
            );
        }

        $modules['System'] = $system_tab;
        $data['modules'] = $modules;
        return view('admin::settings.index', ['data' => $data]);
    }

    public function update(Request $request) {
        if (isset($request['settings']) && is_array($request['settings'])) {
            if (isset($request['settings']['selling_percentage']) && !is_numeric($request['settings']['selling_percentage'])) {
                $request->session()->put('selected_tab', isset($request['tab']) ? $request['tab'] : 1);
                return redirect()->back()->with('danger', 'Please give a proper selling percentage.');
            }
            foreach ($request['settings'] as $slug => $sett) {
                $row1 = Setting::where(['slug' => $slug])->first();
                if ($row1) {
                    $row1->value = $sett;
                    $row1->save();
                }
            }
            $request->session()->put('selected_tab', isset($request['tab']) ? $request['tab'] : 1);
            return redirect()->route('admin-settings')->with('success', 'Global Settings updated successfully.');
        }
    }

}
