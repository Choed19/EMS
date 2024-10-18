<?php

namespace App\Imports;

use App\Models\equipment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class EquipmentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        set_time_limit(60);
        // dd($row);
        // Convert Excel serial date for 'buydate'
        if (isset($row['buydate']) && is_numeric($row['buydate'])) {
            $buyDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['buydate'])->format('Y-m-d');
        } else {
            Log::warning('Invalid date format for buydate:', ['buydate' => $row['buydate'] ?? 'N/A']);
            $buyDate = null;
        }

        // Convert Excel serial date for 'create_time'
        if (isset($row['createtime']) && is_numeric($row['createtime'])) {
            $createTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['createtime'])->format('Y-m-d H:i:s');
        } else {
            Log::warning('Invalid datetime format for createtime:', ['createtime' => $row['createtime'] ?? 'N/A']);
            $createTime = null;
        }

        // Convert Excel serial date for 'updatetime'
        if (isset($row['updatetime']) && is_numeric($row['updatetime'])) {
            $updatetime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['updatetime'])->format('Y-m-d H:i:s');
        } else {
            Log::warning('Invalid datetime format for updatetime:', ['updatetime' => $row['updatetime'] ?? 'N/A']);
            $updatetime = null;
        }

        $existingEquipment = Equipment::where('serial_no', $row['serialno'])->first();

        if ($existingEquipment) {
            // ถ้าพบว่า serial_no นี้มีอยู่ในฐานข้อมูลแล้ว
            Log::warning('Duplicate serial_no found:', ['serial_no' => $row['serialno']]);
            return null;
        } // ไม่ทำการบันทึกข้อมูลนี้

        // Validate cost
        $cost = (float) $row['cost'];
        $maxCost = 99999999.99;

        if (!is_numeric($cost) || $cost > $maxCost) {
            Log::warning('Cost value out of range:', ['cost' => $cost]);
            $cost = $maxCost;
        }

        // Return new model instance
        return new Equipment([
            'year' => $row['year'] ?? '',
            'equipment_group' => $row['eqgroup'] ?? '',
            'serial_no' => $row['serialno'] ?? '',
            'equipment_name' => $row['equipmentname'] ?? '',
            'cost' => $cost,
            'buy_date' => $this->convertExcelDate($row['buydate']),  // Converted buy date
            'department_name' => $row['departmentname'] ?? '',
            'building_no' => $row['buildingno'] ?? '',
            'room_no' => $row['roomno'] ?? '',
            'status' => $row['status'] ?? '',
            'status_borrow' => $row['status_borrow'] ?? '',
            'create_time' => $this->convertExcelDate($row['createtime']),  // Converted create time
            'create_by' => $row['createby'] ?? '',
            'update_time' => $this->convertExcelDate($row['updatetime']),  // Converted update time
            'update_by' => $row['updateby'] ?? '',
        ]);
    }
    // private $current = 0 ;
    // public function model(array $row)
    // {
    //     dd($row);
    //     \Log::info('Row Data: ' . json_encode($row));
    //     try {
    //         return new equipment([
    //             'GroupofEquipment' => $row['group_of_equipment'],
    //             'SerialNo' => $row['serial_no'],
    //             'NameEquipment' => $row['name'],
    //             'cost' => $row['cost_baht'],
    //             'location' => $row['location'],
    //             'StartingDate' => $row['starting_date'],
    //             'Status' => $row['status'],
    //             'Company' => $row['company'],
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error('Error processing row: ' . json_encode($row) . ' | Error: ' . $e->getMessage());
    //     }
    // } 
    // return new Equipment([
    //     'group_of_equipment' => $row['group_of_equipment'],
    //     'serial_no' => $row['serial_no'],
    //     'name' => $row['name'],
    //     'cost_baht' => $row['cost_baht'], // Updated name
    //     'location' => $row['location'],
    //     'starting_date' => $row['starting_date'],
    //     'status' => $row['status'],
    //     'search_name' => $row['search_name'], // Updated name
    //     'current' => $row['current'], // Updated name
    //     'company' => $row['company'],
    //     'model' => $row['model'],
    //     'operation' => $row['operation'], // Updated name
    //     'tax' => $row['tax'], // Updated name
    // ]);

    // }
    // {
    //     return new Equipment([
    //         'group_of_equipment' => $row[0],
    //         'serial_no' => $row[1],
    //         'name' => $row[2],
    //         'cost_baht' => $row[3],
    //         'location' => $row[4],
    //         'starting_date' => $row[5],
    //         'status' => $row[6],
    //         'search_name_current' => $row[7],
    //         'company' => $row[8],
    //         'model' => $row[9],
    //         'operation' => $row[10],
    //         'tax' => $row[11],
    //     ]);
    // }
    //     public function model(array $row)
    // {
    // $this->current++;
    // if( $this->current > 1){
    //     $equipment = new equipment();
    //     $equipment->group_of_equipment =  $row[0];
    //     $equipment->serialNo =  $row[1];
    //     $equipment->name =  $row[2];
    //     $equipment->cost_baht =  $row[3];
    //     $equipment->location =  $row[4];
    //     $equipment->StartingDate =  $row[5];
    //     $equipment->Status =  $row[6];
    //     $equipment->ชื่อสำหรับค้นหา =  $row[7];
    //     $equipment->ปัจจุบัน =  $row[8];
    //     $equipment->Company =  $row[9];
    //     $equipment->Model =  $row[10];
    //     $equipment->การดำเนินการงาน =  $row[11];
    //     $equipment->ภาษี =  $row[12];
    //     $equipment->save();
    // } 
    // Debugging the row data
    // \Log::info('Processing row: ' . json_encode($row));
    // dd($row);
    // Ensure a model instance is returned
    //     return new Equipment([
    //         'group_of_equipment' => $row[0],
    //         'serialNo' => $row[1],
    //         'name' => $row[2],
    //         'cost(baht)' => $row[3],
    //         'location' => $row[4],
    //         'StartingDate' => $row[5],
    //         'Status' => $row[6],
    //         'ชื่อสำหรับค้นหา' => $row[7],
    //         'ปัจจุบัน' => $row[8],
    //         'Company' => $row[9],
    //         'Model' => $row[10],
    //         'การดำเนินการงาน' => $row[11],
    //         'ภาษี' => $row[12],
    //     ]);
    // }
    private function convertExcelDate($excelDate)
    {
        if (isset($excelDate) && is_numeric($excelDate)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate)->format('Y-m-d');
        }
        return null;
    }


}
