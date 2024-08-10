<?php

// app/Exports/SalesReportExport.php
namespace App\Exports;

use App\Models\Concert;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $concerts;
    private $counter = 0;

    public function __construct($concerts)
    {
        $this->concerts = $concerts;
    }

    public function collection()
    {
        return $this->concerts;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Konser',
            'Tanggal',
            'Tiket Terjual',
            'Total Keuntungan',
        ];
    }

    public function map($concert): array
    {
        return [
            ++$this->counter,
            $concert->name,
            \Carbon\Carbon::parse($concert->date)->format('F d, Y'),
            $concert->total_sold,
            $concert->total_revenue,
        ];
    }
}
