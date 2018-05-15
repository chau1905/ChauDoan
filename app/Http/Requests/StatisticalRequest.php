<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StatisticalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    const TYPE_YEAR = 'year';
    const TYPE_MONTH = 'month';
    const TYPE_DAY = 'day';
    const TYPE_CHOOSE_DAY = 'choose-day';
    const STATISTIC_NUMBER_YEAR = 10;
    const YEAR_BEGIN = 2016;
    const MONTHS = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    const TYPE_BAR = 1;
    const TYPE_LINE = 2;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'status' => [
                'nullable',
                Rule::in([self::TYPE_YEAR, self::TYPE_MONTH, self::TYPE_DAY, self::TYPE_CHOOSE_DAY]),
            ],
            'chart' => [
                'nullable',
                Rule::in([self::TYPE_BAR, self::TYPE_LINE]),
            ],
            'month' => [
                'nullable',
                'required_if:type,'.self::TYPE_DAY,
                Rule::in(self::MONTHS),
            ],
            'year' => [
                'nullable',
                'required_if:type,'.self::TYPE_MONTH.','.self::TYPE_DAY,
                Rule::in(self::getYears())
            ],
            'time-start' => 'date|nullable|required_if:type,'.self::TYPE_CHOOSE_DAY,
            'time-end' => 'date|nullable|after_or_equal:time-start|required_if:type,'.self::TYPE_CHOOSE_DAY,
        ];
    }

    /**
     * @return array
     */
    public static function getFilterTypes()
    {
        return [
            self::TYPE_YEAR => trans('messages.year'),
            self::TYPE_MONTH => trans('messages.month'),
            self::TYPE_DAY => trans('messages.day')
        ];
    }

    /**
     * @return array
     */
    public static function getFilterYears()
    {
        $years = [];
        $yearTo = date('Y');
        $year = self::YEAR_BEGIN;
        while ($year <= $yearTo) {
            $years[$year] = $year;
            $year++;
        }

        return $years;
    }

    /**
     * @return array
     */
    public static function getYears()
    {
        $years = [];
        $yearTo = date('Y');
        $year = self::YEAR_BEGIN;
        while ($year <= $yearTo) {
            $years[] = $year;
            $year++;
        }

        return $years;
    }

    /**
     * @return array
     */
    public static function getFilterMonths()
    {
        $months = [];
        foreach (self::MONTHS as $month) {
            $months[$month] = trans('messages.month').' '.$month;
        }

        return $months;
    }
}
