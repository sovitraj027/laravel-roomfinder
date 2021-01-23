<?php

namespace App\Http\Controllers;

use App\User;
use App\RequestReport;
use App\ReportCategory;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\DB;
use App\Notifications\RequestAndReportNotification;

class RequestReportController extends Controller
{
    public function index()
    {
        return view('request_report.index', [
            'request_reports' => RequestReport::all()
        ]);
    }

    public function create()
    {
        return view('request_report.create', [
            'report_categories' => ReportCategory::where('id', '!=', 3)->get()
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest();

        DB::beginTransaction();
        try {
            RequestReport::create([
                'title' => $request->title,
                'report_category_id' => $request->report_category_id,
                'justification' => $request->justification,
                'user_id' => auth()->id(),
                'reported_user_id' => $request->reported_user_id
            ]);

            if (\Notification::send(
                User::where('admin', 1)->first(),
                new RequestAndReportNotification(RequestReport::latest('id')->first())
            )) {
                return back();
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return redirect()->route('request_report.index')->with('success', 'Report/Request ' . AppHelper::DataAdded);
    }

    public function show(RequestReport $requestReport)
    {
        if ($requestReport->reported_user_id) {
            $reported_user = User::select('id', 'name', 'role')->findOrFail($requestReport->reported_user_id);
        } else {
            $reported_user = "";
        }

        return view('request_report.show', [
            'request_report' => $requestReport,
            'reported_user' => $reported_user
        ]);
    }


    public function edit(RequestReport $requestReport)
    {
        return view('request_report.edit', [
            'report_categories' => ReportCategory::where('id', '=', 2)->get(),
            'requestReport' => $requestReport
        ]);
    }

    public function update(Request $request, RequestReport $requestReport)
    {
        $this->validateRequest();

        $requestReport->update([
            'title' => $request->title,
            'report_category_id' => $request->report_category_id,
            'justification' => $request->justification,
        ]);
        return redirect()->route('request_report.index')->with('success', 'Report/Request ' . AppHelper::DataUpdated);
    }

    public function destroy(RequestReport $requestReport)
    {
        $requestReport->delete();
        return redirect()->back()->with('error', 'Request/Report ' . AppHelper::DataDeleted);
    }

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|string|min:5',
            'report_category_id' => 'required',
            'justification' => 'required|string|min:5'
        ]);
    }

    public function show_report_form($reported_user_id)
    {
        // dd($reported_user_id);
        return view('request_report.report', [
            'reported_user_id' => $reported_user_id
        ]);
    }
}
