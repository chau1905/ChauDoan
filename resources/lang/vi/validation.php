<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Thuộc tính :attribute phải được chấp nhận..',
    'active_url'           => 'Trường :attribute không phải là một URL.',
    'after'                => 'Trường :attribute phải là một thời gian sau :date.',
    'after_or_equal'       => 'Trường :attribute phải là một thời gian lớn hơn hoặc bằng :date.',
    'alpha'                => 'Trường :attribute Chỉ có thể chứa chữ cái.',
    'alpha_dash'           => 'Trường :attribute chỉ có thể là chữ cái, số và dấu gạch ngang.',
    'alpha_num'            => 'Trường :attribute chỉ có thể là chữ cái, số .',
    'array'                => 'Trường :attribute phải là một mảng.',
    'before'               => 'Trường :attribute phải là một thời gian gian trước :date.',
    'before_or_equal'      => 'Trường :attribute phải là một thời gian nhỏ hơn hoặc bằng :date.',
    'between'              => [
        'numeric' => 'Trường :attribute phải lớn hơn :min và nhỏ hơn :max.',
        'file'    => 'Trường :attribute phải lớn hơn :min và nhỏ hơn :max kilobytes.',
        'string'  => 'Trường :attribute phải lớn hơn :min và nhỏ hơn :max kí tự.',
        'array'   => 'Trường :attribute phải lớn hơn :min và nhỏ hơn :max .',
    ],
    'boolean'              => 'Trường :attribute phải là true hoặc false.',
    'confirmed'            => 'Trường :attribute xác nhận không khớp.',
    'date'                 => 'Trường :attribute không phải là thời gian.',
    'date_format'          => 'Trường :attribute không khớp với định dạng :format.',
    'different'            => 'Trường :attribute và :other phải khác nhau.',
    'digits'               => 'Trường :attribute :digits phải là số.',
    'digits_between'       => 'Trường :attribute must be between :min and :max digits.',
    'dimensions'           => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct'             => 'Trường :attribute có giá trị trùng lặp.',
    'email'                => 'Trường :attribute phải là một địa chỉ email.',
    'exists'               => 'Trường :attribute đã chọn không hợp lệ.',
    'file'                 => 'Trường :attribute phải là một file.',
    'filled'               => 'Trường :attribute phải có một giá trị.',
    'image'                => 'Trường :attribute phải là một hình ảnh.',
    'in'                   => 'Trường :attribute đã chọn không hợp lệ.',
    'in_array'             => 'Trường :attribute không tồn tại trong :other.',
    'integer'              => 'Trường :attribute Phải là số nguyên.',
    'ip'                   => 'Trường :attribute không phải là một địa chỉ IP.',
    'ipv4'                 => 'Trường :attribute không phải là một địa chỉ IPv4.',
    'ipv6'                 => 'Trường :attribute không phải là một địa chỉ IPv6.',
    'json'                 => 'Trường :attribute phải là một chuỗi JSON.',
    'max'                  => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file'    => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'string'  => 'Trường :attribute không được lớn hơn :max kí tự.',
        'array'   => 'Trường :attribute không được lớn hơn :max phần tử.',
    ],
    'mimes'                => 'Trường :attribute phải là một file: :values.',
    'mimetypes'            => 'Trường :attribute phải là một loại file: :values.',
    'min'                  => [
        'numeric' => 'Trường :attribute lớn hơn :min.',
        'file'    => 'Trường :attribute lớn hơn :min kilobytes.',
        'string'  => 'Trường :attribute lớn hơn :min kí tự.',
        'array'   => 'Trường :attribute lớn hơn :min phần tử.',
    ],
    'not_in'               => 'Trường :attribute đã chọn không hợp lệ.',
    'numeric'              => 'Trường :attribute phải là một số.',
    'regex'                => 'Trường :attribute định dạng không hợp lệ.',
    'required'             => ':attribute không được rỗng',
    'required_if'          => 'Trường :attribute yêu cầu khi :other là :value.',
    'required_unless'      => 'Trường :attribute trường được yêu cầu trừ khi :other trong :values.',
    'required_with'        => 'Trường :attribute trường này yêu cầu khi :values hiện diện.',
    'required_with_all'    => 'Trường :attribute trường này yêu cầu khi :values hiện diện.',
    'required_without'     => 'Trường :attribute field is required when :values is not present.',
    'required_without_all' => 'Trường :attribute field is required when none of :values are present.',
    'same'                 => 'Trường :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'Trường :attribute phải là :size.',
        'file'    => 'Trường :attribute phải là :size kilobytes.',
        'string'  => 'Trường :attribute phải là :size characters.',
        'array'   => 'Trường :attribute phải có :size phần tử.',
    ],
    'string'               => 'Trường :attribute phải là một chuỗi.',
    'timezone'             => 'Trường :attribute phải là một vùng thời gian hợp lệ.',
    'unique'               => 'Trường :attribute không được trùng.',
    'uploaded'             => 'Trường :attribute không thể tải lên.',
    'url'                  => 'Trường :attribute định dạng không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],
    'string_in' => 'Các dự án không hợp lệ'

];
