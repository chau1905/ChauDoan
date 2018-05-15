<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{trans('messages.detail_product_lable')}}</h4>
        </div>
        <div class="modal-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>{{trans('messages.stt_lable')}}</th>
                    <th>Tên nhân viên</th>
                    <th>Chức vụ</th>
                    <th>Ca làm</th>
                    <th>Thời gian chấm công</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                @forelse ($timekeepings as $timekeeping)
                    <tr>
                        <td style="padding-bottom: 20px;">{{$i}}</td>
                        <td>{{$timekeeping->name}}</td>
                        <td>
                            @if($timekeeping->type_user == \App\User::ADMIN)
                                Quản trị viên
                            @elseif($timekeeping->type_user == \App\User::EMPLOYEES)
                                Nhân viên
                            @endif

                        </td>
                        <td>
                            @if($timekeeping->type == \App\TimeKeeping::CA_SANG)
                                Ca sáng
                            @elseif($timekeeping->type == \App\TimeKeeping::CA_TOI)
                                Ca tối
                            @endif
                        </td>
                        <td>{{$timekeeping->time}}</td>
                    </tr>
                    <?php $i++ ?>
                @empty
                    <tr>
                        <td colspan="12"><h2 class="text-center no_data">{{ trans('messages.no_data') }}</h2></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
