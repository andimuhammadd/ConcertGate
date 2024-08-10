<?php

namespace App\Exports;

use App\Models\Concert;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConcertDetailExport implements WithMultipleSheets
{
    protected $concert;

    public function __construct(Concert $concert)
    {
        $this->concert = $concert;
    }

    public function sheets(): array
    {
        return [
            new CombinedInfoSheet($this->concert),
            new OrderListSheet($this->concert),
        ];
    }
}

class CombinedInfoSheet implements FromArray, WithHeadings, WithTitle, WithStyles
{
    protected $concert;

    public function __construct(Concert $concert)
    {
        $this->concert = $concert;
    }

    public function array(): array
    {
        // Collect concert info
        $concertInfo = [
            ['Concert Info'],
            ['Nama Konser', 'Tanggal', 'Deskripsi', 'Venue', 'Tiket Terjual', 'Total Keuntungan'],
            [
                $this->concert->name,
                \Carbon\Carbon::parse($this->concert->date)->format('F d, Y'),
                $this->concert->description,
                $this->concert->venue,
                $this->concert->tickets->sum(fn ($ticket) => $ticket->orderItems->sum('quantity')),
                'Rp. ' . number_format($this->concert->tickets->sum(fn ($ticket) => $ticket->orderItems->sum(fn ($item) => $item->price * $item->quantity)), 2, ',', '.')
            ],
            [''], // Empty row to separate sections
            ['Ticket List'], // Title for ticket list section
            ['No', 'Jenis Tiket', 'Harga', 'Jumlah Terjual', 'Total Keuntungan']
        ];

        // Collect ticket list
        $ticketList = $this->concert->tickets->map(function ($ticket, $index) {
            return [
                $index + 1,
                $ticket->type,
                'Rp. ' . number_format($ticket->price, 2, ',', '.'),
                $ticket->orderItems->sum('quantity'),
                'Rp. ' . number_format($ticket->orderItems->sum(fn ($item) => $item->price * $item->quantity), 2, ',', '.')
            ];
        })->toArray();

        // Combine concert info and ticket list with separation
        return array_merge($concertInfo, $ticketList);
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return 'Concert & Tickets';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]], // Concert Info title
            2    => ['font' => ['bold' => true]], // Concert Info headings
            5    => ['font' => ['bold' => true]], // Ticket List title
            6    => ['font' => ['bold' => true]], // Ticket List headings
        ];
    }
}

class OrderListSheet implements FromArray, WithHeadings, WithTitle
{
    protected $concert;
    private $counter = 0; // Counter for numbering

    public function __construct(Concert $concert)
    {
        $this->concert = $concert;
    }

    public function array(): array
    {
        return $this->concert->tickets->flatMap->orderItems->map(function ($orderItem) {
            return [
                ++$this->counter, // Increment and return the counter
                $orderItem->order->firstname . ' ' . $orderItem->order->lastname,
                $orderItem->order->email,
                $orderItem->order->phone,
                $orderItem->ticket->type,
                'Rp. ' . number_format($orderItem->price * $orderItem->quantity, 2, ',', '.'),
                $orderItem->order->payments->isNotEmpty() ? $orderItem->order->payments->first()->payment_method : '-',
            ];
        })->toArray();
    }

    public function headings(): array
    {
        return [
            'No',
            'Pembeli',
            'Email',
            'No Telp',
            'Jenis Tiket',
            'Harga Total',
            'Metode Pembayaran'
        ];
    }

    public function title(): string
    {
        return 'Order List';
    }
}
