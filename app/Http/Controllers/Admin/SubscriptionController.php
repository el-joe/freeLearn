<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GeneralExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with([
            'lesson'=>fn($q)=>$q->with('subject','academicYear','instructor') ,
            'user'
        ])->latest()->get();

        if(request('export') == 1){
            $index = 0;
            $data = $subscriptions->groupBy('lesson.instructor.name')->map(function ($subscriptions,$instructor)use(&$index){
                return $subscriptions->groupBy('lesson_id')->map(function ($subscriptions,$lessonId) use($instructor,&$index) {
                    $data = [
                        'Lesson'=>$lessonId,
                        'Instructor'=>$instructor??'Unknown',
                        'Paid'=>$subscriptions->count(),
                    ];

                    if($index == 0){
                        $data['Download Date'] = now()->format('Y/m/d H:i:s');
                        $index += 1;
                    }

                    return $data;
                })->sortBy('Lesson');
            })->values();

            $titles = [
                'Lesson','Instructor','Paid','Download Date'
            ];

            $data->prepend($titles);

            return Excel::download(new GeneralExport($data), 'subscriptions.xlsx');
        }

        return view('admin.subscriptions.index',get_defined_vars());
    }

    function orders() {
        $orders = Order::latest()->get();

        return view('admin.subscriptions.orders',get_defined_vars());
    }
}
