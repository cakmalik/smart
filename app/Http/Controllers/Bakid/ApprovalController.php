<?php

namespace App\Http\Controllers\Bakid;

use App\Tables\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Student\RoomStudent;
use App\Http\Controllers\Controller;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use App\Services\Approval\ApprovalService;
use App\Models\Student\FormalEducationStudent;
use App\Models\Student\InformalEducationStudent;

class ApprovalController extends Controller
{
    private $model;
    public function __construct(ApprovalService $approvalService)
    {
        $this->model = $approvalService;
    }

    public function index(Request $request, $category)
    {
        switch ($category) {
            case 'formal':
                $colName = 'formal.name';
                $title = 'formal';
                break;
            case 'nonformal':
                $colName = 'informal.name';
                $title = 'nonformal';
                break;

            default:
                $colName = 'asrama';
                $title = 'asrama';
                break;
        }

        $data = SpladeTable::for($this->query($request, $category))
        ->column('student.name')
        ->column('tujuan')
        ->withGlobalSearch()
        ->column('action');
// dd($data->data);

        return view(
            'bakid.approval.index',
            [
                'data' => $data,
                'title' => $title
            ]
        );
    }

    private function query($request, $category)
    {
        switch ($category) {

            case 'dropout':
                break;

            case 'asrama':
                return QueryBuilder::for(RoomStudent::class)
                    ->with('student', 'room.dormitory')
                    ->where('status', 'waiting')
                    ->paginate()
                    ->withQueryString();
                break;

            case 'formal':
                return QueryBuilder::for(FormalEducationStudent::class)
                    ->with('student', 'formal')
                    ->where('status', 'waiting')
                    ->paginate()
                    ->withQueryString();
                break;

            case 'nonformal':
                return QueryBuilder::for(InformalEducationStudent::class)
                    ->with('student', 'informal')
                    ->where('status', 'waiting')
                    ->paginate()
                    ->withQueryString();
                break;

            default:
                break;
        }
    }

    function action($id, $category)
    {
        try {
            switch ($category) {
                case 'asrama':
                    // check quota
                    $find = RoomStudent::with('room')->find((int)$id);
                    if ($find->room?->curent_capacity < 1) {
                        Toast::danger('Mohon maaf, Kuota kamar tersebut penuh');
                        return back();
                    }
                    $find->status = 'approved';
                    $find->save();
                    break;

                case 'formal':
                    // check quota
                    $find = RoomStudent::with('room')->find((int)$id);
                    if ($find->room?->curent_capacity < 1) {
                        Toast::danger('Mohon maaf, Kuota kamar tersebut penuh');
                        return back();
                    }
                    $find->status = 'approved';
                    $find->save();
                    break;

                default:
                    # code...
                    break;
            }

            Toast::success('Pengajuan Berhasil diterima');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}