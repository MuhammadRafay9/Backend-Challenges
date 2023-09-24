<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{
    //
    public function uploadAttendance(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Get the uploaded file
        $file = $request->file('excel_file');

        try {
            // Load the Excel file
            $spreadsheet = IOFactory::load($file);

            // Get the active worksheet (assuming you're interested in the first sheet)
            $worksheet = $spreadsheet->getActiveSheet();

            // Get all the data from the worksheet
            $data = $worksheet->toArray();

            foreach ($data as $key => $value) {
                $employee_id = Employee::where('emp_id', $value[0])->select('id')->get()->value('id');
                $date = date('Y-m-d', strtotime($value[1]));
                Attendance::updateOrInsert(
                    [
                        'employee_id' => $employee_id,
                        'date' => $date,
                    ],
                    [
                        'employee_id' => $employee_id,
                        'date' => $date,
                        'clockin' => $value[2],
                        'clockout' => $value[3],
                    ]
                );
            }

            // Return the request data and a success message as JSON
            return response()->json([
                'message' => 'File uploaded successfully',
                'data' => $request->all(),
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the upload
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }

    public function viewAttendance(Request $request)
    {
        try {
            $query = "
                        SELECT
                            e.name,
                            a.date,
                            TIME_FORMAT(a.clockin, '%h:%i %p') AS clockin_formatted,
                            TIME_FORMAT(a.clockout, '%h:%i %p') AS clockout_formatted,
                            TIMEDIFF(a.clockout, a.clockin) AS total_working_hours
                        FROM
                            employees e
                        INNER JOIN
                            locations l ON l.id = e.location_id
                        INNER JOIN
                            attendance a ON a.employee_id = e.id
                        ORDER BY
                            e.id,
                            a.date
                ";
            $result = DB::select($query);

            return response()->json([
                'message' => 'File uploaded successfully',
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the upload
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function Challenge2()
    {
        $count = 0;
        $array1 = [2, 1, 2, 3, 4, 3];
        $array2 = [];

        for ($index = 0; $index < count($array1); $index++) {
            $count = 0;
            for ($index1 = 0; $index1 < count($array1); $index1++) {
                if ($array1[$index1] == $array1[$index]) {
                    ++$count;
                }
            }
            if ($count > 1) {
                $array2[] = $array1[$index];
            }

        }
        return $array2;
    }

    public function Challenge4()
    {
        $fileCompanyArray = array(
            "insurance.txt" => "Company A",
            "letter.docx" => "Company A",
            "Contract.docx" => "Company B"
        );

        $newArray = [];
        
        foreach ($fileCompanyArray as $key => $value) {
            $newArray[$value][] = $key; 
        }
        return $newArray;
    }

}
