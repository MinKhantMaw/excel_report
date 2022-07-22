<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromCollection, WithHeadings, WithEvents, WithTitle,ShouldAutoSize,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($email)
    {
        $this->email=$email;
    }

    public function collection()
    {

        $user = User::select('id','name','email','phone','address')
        ->orderBy('id','desc');

            if($this->email != null){
            $user->where('email',$this->email);
            }

            $user = $user->get();

            $rowindex = 0;
            foreach($user as $data){
              $data->id = ++$rowindex;
            }

            return $user;
    }

    public function headings(): array
    {

       return [
            'No',
            'Name',
            'Email',
            'Phone',
            'Address',
       ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            $user->address,
        ];

    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'F' => NumberFormat::FORMAT_DATE_YYYYMMDD,
    //     ];
    // }

    public function title(): string
    {
        return 'Dormant Account Report';
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:E1')
                                ->getFont()
                                ->setBold(true);

                $event->sheet->getDelegate()->getStyle('E')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            },
        ];
    }
}
