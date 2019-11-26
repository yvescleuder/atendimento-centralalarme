<?php

namespace App\Http\Controllers;

use App\Company;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AttendanceExportController extends Controller implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithDrawings, WithCustomStartCell
{
    private $company_id;
    private $month;
    private $year;
    private $monthName;

    public function __construct(int $company_id, int $month, int $year)
    {
        $monthObj = Carbon::createFromFormat('m', $month)->locale('pt_BR');
        $this->monthName = $monthObj->monthName;
        $this->company_id = $company_id;
        $this->month = $month;
        $this->year = $year;
    }

    private function getLogo()
    {
        $company = Company::select('logo')->find(1);
        return $company['logo'];
    }

    public function collection()
    {
        return \DB::table('attendances')
            ->join('companies', 'attendances.company_id', '=', 'companies.id')
            ->join('agents', 'attendances.agent_id', '=', 'agents.id')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->where('company_id', '=', $this->company_id)
            ->whereMonth('attendances.created_at', $this->month)
            ->whereYear('attendances.created_at', $this->year)
            ->select(\DB::raw('DATE_FORMAT(attendances.created_at, "%d/%m/%Y") as data'), 'attendances.client', 'attendances.requester', 'users.first_name', 'agents.name', 'attendances.time_trigger', 'attendances.time_checkin', 'attendances.time_exit', 'attendances.note')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Data',
            'Cliente',
            'Solicitante',
            'Atendente',
            'Agente',
            'Horário de acionamento',
            'Horário de chegada',
            'Horário de saida',
            'Anotações ou observações da central'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRangeBorder = 'A3' . ':' . $event->sheet->getDelegate()->getHighestColumn() . $event->sheet->getDelegate()->getHighestRow();
                $cellRange = 'A3:I3';
                // Mescla as cells
                $event->sheet->getDelegate()->mergeCells('A1:I1');
                $event->sheet->getDelegate()->mergeCells('A2:I2');
                // Altera o tamanho da row para 30
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(30);
                // Adiciona o texto na primeira linha.
                $event->sheet->getDelegate()->setCellValue('A1', "Planilha de atendimentos diários de $this->year");
                // Faz o estilo da primeira linha
                $event->sheet->getDelegate()->getStyle('A1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'ffffff'],
                        'size' => 18
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '000000'],
                    ]
                ]);
                // Adiciona o texto na segunda linha.
                $event->sheet->getDelegate()->setCellValue('A2', "IMPERATRIZ - ".ucfirst($this->monthName)."/$this->year");
                // Faz o estilo da segunda linha
                $event->sheet->getDelegate()->getStyle('A2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'ffffff'],
                        'size' => 18
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '525252'],
                    ]
                ]);
                // Adicionar cor (branca), background (cinza) e deixa centralizado, altera o tamanho
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'ffffff'],
                        'size' => 14
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '525252']
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
                // Adiciona as bordas e alinha no centro em todos os campos preenchidos
                $event->sheet->getDelegate()->getStyle($cellRangeBorder)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
            },
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setPath(public_path($this->getLogo()));
        $drawing->setHeight(80);
        $drawing->setWidth(120);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
