<?php

namespace App\Exports;

use App\Models\AttendanceEmployee;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceEmployeeExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = AttendanceEmployee::all();

        foreach ($data as $k => $attendanceEmployee) {
            // Mengambil latitude dan longitude dari data AttendanceEmployee
            $latitude = $attendanceEmployee->latitude;
            $longitude = $attendanceEmployee->longitude;

            // Membuat tautan Google Maps berdasarkan latitude dan longitude
            $googleMapsLink = "=HYPERLINK(\"https://www.google.com/maps?q=" . $latitude . "," . $longitude . "\", \" Lihat Peta \")";

            // Menambahkan tautan Google Maps ke dalam data
            $data[$k]["Google Maps"] = $googleMapsLink;

            // Mengganti employee_id dengan nama pegawai
            $data[$k]["Employee_id"] = Employee::employee_name($attendanceEmployee->employee_id);
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "ID",
            "Employee_id",
            "Date",
            "Status",
            "Clock_in",
            "Clock_out",
            "Late",
            "Early_Leaving",
            "Overtime",
            "Total_rest",
            "latitude",
            "longitude",
            "Created_by",
            "Created_at",
            "Updated_at",
            "Google Maps"
        ];
    }
}