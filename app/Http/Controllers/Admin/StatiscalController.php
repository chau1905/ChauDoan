<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatisticalRequest;
use App\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class StatiscalController extends Controller
{
    public function index(StatisticalRequest $request)
    {

        $data = [];

        $dataArr = [];



        if ($request->input('status') == $request::TYPE_CHOOSE_DAY) {
            $bills = Order::select(DB::raw('DATE(created_at) AS date'), DB::raw('sum(total) AS total'))
                ->where('status', '=', Order::PAID)
                ->where('created_at', '>=', $request->input('time-start'))
                ->where('created_at', '<=', date_format(date_create($request->input('time-end')), 'Y-m-d 23:59:59'))
                ->groupBy('date')
                ->get();

//            Time start
            $dayStart = Carbon::parse($request->input('time-start'))->format('d');
            $monthStart = Carbon::parse($request->input('time-start'))->format('m');
            $yearStart = Carbon::parse($request->input('time-start'))->format('Y');
//            Time End
            $monthEnd = Carbon::parse($request->input('time-end'))->format('m');
            $yearEnd = Carbon::parse($request->input('time-end'))->format('Y');

            $dayEnd = Carbon::parse($request->input('time-end'))->format('d');

            if ($yearEnd - $yearStart > 1) {
                return redirect()->back()->with(
                    'alert-warning',
                    trans('messages.statistical_too_long')
                );
            }

            if ($yearStart == $yearEnd) {
//                Month
                if($monthEnd - $monthStart >= 1) {
                    for ($i = abs($monthStart) ; $i <= $monthEnd; $i++) {
                        $numberTimeStartDay = cal_days_in_month(CAL_GREGORIAN, $i, $yearStart);
                        if($monthStart == abs($i)) {
                            for ($day = abs($dayStart) ; $day <= $numberTimeStartDay; $day++) {
                                $dataArr[$yearStart.'-'.self::formatNumber($i).'-'.self::formatNumber($day)] = ['total' => 0];
                            }
                        } elseif (abs($monthEnd) == $i) {
                            for ($day = 1 ; $day <= abs($dayEnd); $day++) {
                                $dataArr[$yearStart.'-'.self::formatNumber($i).'-'.self::formatNumber($day)] = ['total' => 0];
                            }
                        } else {
                            for ($day = 1; $day <= $numberTimeStartDay ; $day++) {
                                $dataArr[$yearStart.'-'.self::formatNumber($i).'-'.self::formatNumber($day)] = ['total' => 0];
                            }
                        }
                    }
                } else {
                    for ($day = abs($dayStart); $day <= $dayEnd; $day++) {
                        $dataArr[$yearStart.'-'.self::formatNumber(abs($monthStart)).'-'.self::formatNumber($day)] = ['total' => 0];
                    }
                }

                if (!count($bills) > 0) {
                    foreach ($dataArr as $key => $value) {
                        $data[] = ['time' => $key, 'value' => $value['total']];
                    }
                    return view('admin.statiscal.index', ['data' => json_encode($data), 'request' => $request->all()]);
                }

                $collection = collect($bills)->keyBy(
                    function ($item) {
                        return Carbon::parse($item['date'])->format('Y-m-d');
                    }
                )->toArray();

            } else {

                for ($month = abs($monthStart); $month <= 12; $month++) {
                    $numberTimeStartDay = cal_days_in_month(CAL_GREGORIAN, $month, $yearStart);
                    if(abs($monthStart) == $month) {
                        for ($day = $dayStart; $day <= $numberTimeStartDay ; $day++) {
                            $dataArr[$yearStart.'-'.self::formatNumber($month).'-'.self::formatNumber($day)] = ['total' => 0];
                        }
                    } else {
                        for ($day = 1; $day <= $numberTimeStartDay ; $day++) {
                            $dataArr[$yearStart.'-'.self::formatNumber($month).'-'.self::formatNumber($day)] = ['total' => 0];
                        }
                    }
                }

                for ($month = 1; $month <= $monthEnd; $month++) {
                    $numberTimeStartDay = cal_days_in_month(CAL_GREGORIAN, $month, $yearEnd);
                    if(abs($monthEnd) == $month) {
                        for ($day = 1; $day <= $dayEnd ; $day++) {
                            $dataArr[$yearEnd.'-'.self::formatNumber($month).'-'.self::formatNumber($day)] = ['total' => 0];
                        }
                    } else {
                        for ($day = 1; $day <= $numberTimeStartDay ; $day++) {
                            $dataArr[$yearEnd.'-'.self::formatNumber($month).'-'.self::formatNumber($day)] = ['total' => 0];
                        }
                    }
                }

                if (!count($bills) > 0) {
                    foreach ($dataArr as $key => $value) {
                        $data[] = ['time' => $key, 'value' => $value['total']];
                    }
                    return view('admin.statiscal.index', ['data' => json_encode($data), 'request' => $request->all()]);
                }

                $collection = collect($bills)->keyBy(
                    function ($item) {
                        return Carbon::parse($item['date'])->format('Y-m-d');
                    }
                )->toArray();
            }

        }elseif($request->input('status') == $request::TYPE_MONTH) {
            for ($i = 1; $i <= 12; $i++) {
                $dataArr[$i] = [
                    'total' => 0
                ];
            }
            $bills = Order::select(DB::raw('MONTH(created_at) AS date'), DB::raw('sum(total) AS total'))
                ->where('status', '=', Order::PAID)
                ->whereYear('created_at', '=', $request->input('year'))
                ->groupBy('date')
                ->get();
            if (!count($bills) > 0) {
                foreach ($dataArr as $key => $value) {
                    $data[] = ['time' => $key, 'value' => $value['total']];
                }
                return view('admin.statiscal.index', ['data' => json_encode($data), 'request' => $request->all()]);
            }

            $collection = collect($bills)->keyBy(
                function ($item) {
                    return $item['date'];
                }
            )->toArray();

        } elseif($request->input('status') == $request::TYPE_DAY) {
//            Type day
            if(!$request->has('month') || !$request->has('year') )
                return redirect()->back()->with('alert-warning', trans('messages.warning_statistical'));


            $numberDay = cal_days_in_month(CAL_GREGORIAN, $request->input('month'), $request->input('year'));
            if (!isset($numberDay) ) return redirect()->back()->with('alert-warning', trans('messages.warning_statistical'));

            for ($i = 1; $i <= $numberDay; $i++) {
                $dataArr[$i] = ['total' => 0];
            }
            $bills = Order::select(DB::raw('DATE(created_at) AS date'), DB::raw('sum(total) AS total'))
                ->where('status', '=', Order::PAID)
                ->whereYear('created_at', '=', $request->input('year'))
                ->whereMonth('created_at', '=', $request->input('month'))
                ->groupBy('date')
                ->get();
            if (!count($bills) > 0) {
                foreach ($dataArr as $key => $value) {
                    $data[] = ['time' => $key, 'value' => $value['total']];
                }
                return view('admin.statiscal.index', ['data' => json_encode($data), 'request' => $request->all()]);
            }
            $collection = collect($bills)->keyBy(function ($item) {
                return abs(Carbon::parse($item['date'])->format('d'));
            })->toArray();
        } else {
//            Type year
            for ($i = $request::YEAR_BEGIN; $i <= date('Y'); $i++) {
                $dataArr[$i] = ['total' => 0];
            }
            $bills = Order::select(DB::raw('YEAR(created_at) AS date'), DB::raw('sum(total) AS total'))
                ->where('status', '=', Order::PAID)
                ->groupBy('date')
                ->get();

            if (!count($bills) > 0) {
                foreach ($dataArr as $key => $value) {
                    $data[] = ['time' => $key, 'value' => $value['total']];
                }
                return view('admin.statiscal.index', ['data' => json_encode($data), 'request' => $request->all()]);
            }

            $collection = collect($bills)->keyBy(
                function ($item) {
                    return abs(Carbon::parse($item['date'])->format('Y'));
                }
            )->toArray();
        }

        foreach ($dataArr as $key => $value) {
            if (isset($collection[$key])) {
                $data[] = ['time' => $key, 'value' =>  $collection[$key]['total']];
            } else {
                $data[] = ['time' => $key, 'value' => 0];
            }
        }

        return view('admin.statiscal.index', ['data' => json_encode($data), 'request' => $request->all()]);

    }

    /**
     * @param $number
     * @return string
     */
    private static function formatNumber($number)
    {
        if ($number >= 10) {
            return $number;
        }

        return '0'.$number;
    }
}
