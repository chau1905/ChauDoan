@extends('admin.layout.app')
@section('content')
    <div class="inner-block">
        <div class="error">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="form_search">
            <div class="jumbotron">
                <form action="{{route('statis.index')}}" method="GET" role="form" class="form-inline ">
                    {{ csrf_field() }}
                    <h3 class="statistical-option" style="margin-bottom: 20px;">{{trans('messages.statistic_type')}}
                        <select class="form-control <?php echo $errors->has('status') ? 'input-error' : '';?>" name="status">
                            <option value="{{\App\Http\Requests\StatisticalRequest::TYPE_YEAR}}">{{trans('messages.year')}}</option>
                            <option value="{{\App\Http\Requests\StatisticalRequest::TYPE_MONTH}}" {{isset($request['type']) ? \App\Http\Requests\StatisticalRequest::TYPE_MONTH == $request['type'] ? 'selected' : '' : ''}}>{{trans('messages.month')}}</option>
                            <option value="{{\App\Http\Requests\StatisticalRequest::TYPE_DAY}}" {{isset($request['type']) ? \App\Http\Requests\StatisticalRequest::TYPE_DAY == $request['type'] ? 'selected' : '' : ''}}>{{trans('messages.day')}}</option>
                            <option value="{{\App\Http\Requests\StatisticalRequest::TYPE_CHOOSE_DAY}}" {{isset($request['type']) ? \App\Http\Requests\StatisticalRequest::TYPE_CHOOSE_DAY == $request['type'] ? 'selected' : '' : ''}}>Chọn ngày</option>
                        </select>
                    </h3>
                    <div class="form-group">
                        <label for="">Loại biểu đồ</label>
                        <select class="form-control <?php echo $errors->has('chart') ? 'input-error' : '';?>" name="chart">
                            <option value="{{\App\Http\Requests\StatisticalRequest::TYPE_BAR}}">Cột</option>
                            <option value="{{\App\Http\Requests\StatisticalRequest::TYPE_LINE}}" {{isset($request['chart']) ? \App\Http\Requests\StatisticalRequest::TYPE_LINE == $request['chart'] ? 'selected' : '' : ''}}>Đường</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('messages.choose_month')}}</label>
                        <select class="form-control <?php echo $errors->has('month') ? 'input-error' : '';?>" name="month">
                            <option value="">{{trans('messages.choose_month')}}</option>
                            @foreach(\App\Http\Requests\StatisticalRequest::getFilterMonths() as $key => $value)
                                <option value="{{$key}}" {{isset($request['month']) ? $key == $request['month'] ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('messages.choose_year')}}</label>
                        <select class="form-control <?php echo $errors->has('year') ? 'input-error' : '';?>" name="year">
                            <option value="">{{trans('messages.choose_year')}}</option>
                            @foreach(\App\Http\Requests\StatisticalRequest::getFilterYears() as $key => $value)
                                <option value="{{$key}}" {{isset($request['year']) ? $key == $request['year'] ? 'selected' : '' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group time-start">
                        <label>Từ</label>
                        <input type="text" class="form-control datepicker" name="time-start"
                               value="{{isset($request['time-start']) ? $request['time-start'] : ''}}">
                    </div>
                    <div class="form-group time-end">
                        <label>Đến</label>
                        <input type="text" class="form-control datepicker" name="time-end"
                               value="{{isset($request['time-end']) ? $request['time-end'] : ''}}">
                    </div>
                    <button type="submit" class="btn btn-primary submit-statistic">Xem</button>
                </form>
            </div>
        </div>
        <h1 class="text-center">{{trans('messages.total_money_statistical')}}</h1>
        <div id="myfirstchart" style="height: 250px;"></div>
        <div class="clearfix"></div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $(".datepicker").datepicker();

            })

            // convert json to array
            String.prototype.replaceAll = function (search, replacement) {
                var target = this;
                return target.replace(new RegExp(search, 'g'), replacement);
            };
            var type = $('select[name=type]').val();
            var d = '{{$data}}';
            d = d.replaceAll("&quot;", '"');
            if (type === "{{\App\Http\Requests\StatisticalRequest::TYPE_CHOOSE_DAY}}") {
                d.replaceAll('"', "'");
            }
            var obj = jQuery.parseJSON(d);
            console.log(obj);


            //            chart line
            var line = [];
            var format_line = "{{isset($request['status']) ? $request['status'] : ''}}";
            var type_chart = "{{isset($request['chart']) ? $request['chart'] : ''}}";

            if (format_line === "{{\App\Http\Requests\StatisticalRequest::TYPE_MONTH}}") {
                var year = "{{isset($request['year']) ? $request['year'] : ''}}";
                console.log('year');
                console.log(year);
                $.each(obj, function (i, item) {
                    line.push({time: year+'-'+item.time.toString(), value: item.value});
                });
            } else if (format_line === "{{\App\Http\Requests\StatisticalRequest::TYPE_DAY}}") {
                var year = "{{isset($request['year']) ? $request['year'] : ''}}";
                var month = "{{isset($request['month']) ? $request['month'] : ''}}";
                $.each(obj, function (i, item) {
                    line.push({time: year+'-'+month+'-'+ item.time.toString(), value: item.value});
                });
            } else {
                $.each(obj, function (i, item) {
                    line.push({time: item.time.toString(), value: item.value});
                });
            }



            var format = '';
            if (format_line === "{{\App\Http\Requests\StatisticalRequest::TYPE_MONTH}}") {
                format = "month";
            } else if (format_line === "{{\App\Http\Requests\StatisticalRequest::TYPE_DAY}}" || format_line === "{{\App\Http\Requests\StatisticalRequest::TYPE_CHOOSE_DAY}}") {
                format = "day";
            } else {
                format = "year";
            }
            if (type_chart == "{{\App\Http\Requests\StatisticalRequest::TYPE_LINE}}") {
                new Morris.Line({
                    // ID of the element in which to draw the chart.
                    element: 'myfirstchart',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: line,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'time',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['value'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Value'],
                    xLabels: format
                });

            } else {
                new Morris.Bar({
                    // ID of the element in which to draw the chart.
                    element: 'myfirstchart',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: obj,
                    // The name of the data record attribute that contains x-values.
                    xkey: ['time'],
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['value'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['Value'],
                    resize: true,
                    grid: true,
                });

            }


        </script>

    @endpush
@endsection