<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Отдел',
            'Пользователь',
            'Экзамен',
            'Время начала',
            'Время окончания',
            'Потраченное время(в минутах)',
            'Номер попытки',
            'Результат (%)'
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            (string)$report->exam->department->title,
            (string)$report->user->fullname,
            (string)$report->exam->title,
            $report->started_at,
            $report->finished_at,
            (string)$report->spent_time,
            (string)$report->attempt_number,
            (string)$report->result
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
