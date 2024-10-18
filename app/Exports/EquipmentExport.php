<?php
namespace App\Exports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EquipmentExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Equipment::all();
    }

    public function headings(): array
    {
        return [
            'year',
            'eqgroup',
            'serialno',
            'equipmentname',
            'cost',
            'buyDate',
            'departmentname',
            'buildingno',
            'roomno',
            'status',
            'status_borrow',
            'createTime',
            'createby',
            'updatetime',
            'updateby'
        ];
    }

    public function map($equipment): array
    {
        return [
            $equipment->year,
            $equipment->equipment_group,
            $equipment->serial_no,
            $equipment->equipment_name,
            $equipment->cost,
            $equipment->buy_date,
            $equipment->department_name,
            $equipment->building_no,
            $equipment->room_no,
            $equipment->status,
            $equipment->status_borrow,
            $equipment->create_time,
            $equipment->create_by,
            $equipment->update_time,
            $equipment->update_by,
        ];
    }
}
