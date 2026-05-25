<?php

namespace App\Exports;

use App\Models\Receipt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RevenueExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $period;
    protected $startDate;
    protected $endDate;

    public function __construct(string $period)
    {
        $this->period = $period;

        if ($period === 'daily') {
            $this->startDate = now()->startOfDay();
            $this->endDate = now()->endOfDay();
        } else {
            $this->startDate = now()->startOfMonth();
            $this->endDate = now()->endOfMonth();
        }
    }

    public function collection()
    {
        return Receipt::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Receipt #',
            'Customer Name',
            'Phone',
            'Services',
            'Subtotal (₹)',
            'Discount %',
            'Total (₹)',
            'Payment Method',
            'Date & Time',
        ];
    }

    public function map($receipt): array
    {
        $serviceNames = collect($receipt->services)->pluck('name')->implode(', ');

        return [
            $receipt->id,
            $receipt->customer_name,
            $receipt->phone ?? 'N/A',
            $serviceNames,
            '₹' . number_format($receipt->subtotal),
            $receipt->discount_percent . '%',
            '₹' . number_format($receipt->total),
            ucfirst($receipt->payment_method),
            $receipt->created_at->format('d M Y, h:i A'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return $this->period === 'daily' ? 'Today\'s Revenue' : 'Monthly Revenue';
    }
}
