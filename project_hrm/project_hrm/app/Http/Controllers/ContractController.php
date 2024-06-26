<?php

namespace App\Http\Controllers;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\ContractType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContractController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $query = Contract::with(['contractType', 'employmentType', 'employee']);
    
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('contract_id', 'like', '%' . $search . '%')
                  ->orWhereHas('employee', function($employeeQuery) use ($search) {
                      $employeeQuery->where('employee_name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('contractType', function($contractTypeQuery) use ($search) {
                      $contractTypeQuery->where('contract_type_name', 'like', '%' . $search . '%');
                  })
                  ->orWhere('contract_duration', 'like', '%' . $search . '%');
            });
        }
    
        $contracts = $search ? $query->paginate(5) : $query->paginate(5);
    
        return view('contracts.index', compact('contracts', 'search'));
    }
    public function show($id) {
        $contract = Contract::with('employee', 'contractType', 'employmentType')->findOrFail($id);
        return view('contracts.show', compact('contract'));
    }
    public function create() {
        $employees = Employee::all();
        $employmentTypes = EmploymentType::all();
        $contractTypes = ContractType::all();
        $error = session('error');
        return view('contracts.create', compact('employees', 'employmentTypes', 'contractTypes', 'error'));
    }
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'employee_name' => 'required',
        //     'employee_id' => 'required',
        //     'contract_id' => 'required',
        //     'contract_type_id' => 'required',
        //     'employment_type_id' => 'required',
        //     'signing_date' => 'required',
        //     'date_start' => 'required',
        //     'date_end' => 'required',
        //     'gross_salary' => 'required',
        //     'insurance_salary' => 'required',
        //     // 'file_path' => 'mimes:png,pdf',
        // ]);
    
        // // Check if validation fails
        // if ($validator->fails()) {
        //     Log::info('Validation errors:');
        //     foreach ($validator->errors()->all() as $error) {
        //         Log::info($error);
        //     }
        //     return redirect()->back()->withInput()->withErrors($validator);
        // }
        // Log::info('Request validated successfully.');

        $messages = [
            'employee_name.required' => 'Họ và tên nhân viên không được để trống.',
            'employee_id.required' => 'Mã nhân viên là bắt buộc.',
            'contract_id.required' => 'Mã hợp đồng không được để trống',
            'contract_type_id.required' => 'Loại hợp đồng không được để trống',
            'employment_type_id.required' => 'Loại hình công việc không được để trống.',
            'signing_date.required' => 'Ngày ký kết không được để trống.',
            'date_start.required' => 'Ngày bắt đầu không được để trống.',
            'date_end.required' => 'Ngày kết thúc khong được để trống.',
            'gross_salary.required' => 'Lương cơ bản không được để trống.',
            'insurance_salary.required' => 'Lương đóng bảo hiểm không được để trống.',
            // 'file_path.mimes' => 'Định dạng file phải là png hoặc pdf.',
        ];
    
        $validator = Validator::make($request->all(), [
            'employee_name' => 'required',
            'employee_id' => 'required',
            'contract_id' => 'required',
            'contract_type_id' => 'required',
            'employment_type_id' => 'required',
            'signing_date' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'gross_salary' => 'required',
            'insurance_salary' => 'required',
            // 'file_path' => 'mimes:png,pdf',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // check HĐ có hiệu lực
        $employeeId = $request->input('employee_id');

        Log::info('Employee ID: ' . $employeeId);

        $existingContract = Contract::where('employee_id', $employeeId)
                                    ->where('date_end', '>=', now())
                                    ->first();
        Log::info('Existing Contract: ' . json_encode($existingContract));

        if ($existingContract) {
            // dd("Here");

            $employeeName = Employee::where('employee_id', $existingContract->employee_id)->value('employee_name');
            $errorMessage = 'Hợp đồng '. $existingContract->contract_id . ' của nhân viên ' . $employeeName . ' đang có hiệu lực. Bạn cần chấm dứt hợp đồng '.$existingContract->contract_id.' trước khi thêm hợp đồng mới.';
            Log::info('Error Message: ' . $errorMessage);
            return redirect()->back()->with('error', $errorMessage);
        }

        $generatedFileName = "";
        if ($request->hasFile('file_path')) {
            $generatedFileName = 'file_' . time() . '_' . $request->contract_id . '.' . $request->file('file_path')->getClientOriginalExtension();
            $request->file('file_path')->move(public_path('files'), $generatedFileName);
            Log::info('File uploaded: ' . $generatedFileName);
        }

        try {
            $contract = Contract::create([
                'employee_id' => $request->employee_id,
                'contract_id' => $request->contract_id,
                'contract_type_id' => $request->contract_type_id,
                'employment_type_id' => $request->employment_type_id,
                'contract_duration' => $request->contract_duration,
                'signing_date' => $request->signing_date,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'gross_salary' => $request->gross_salary,
                'insurance_salary' => $request->insurance_salary,
                'file_path' => $generatedFileName,
                'note' => $request->note
            ]);

            Log::info('Contract created successfully.');

        } catch (\Exception $e) {
            Log::error('Error saving contract: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Error saving contract']);
        }

        return redirect('/contracts');
    }
    public function edit($id) {
        $employees = Employee::all();
        $employmentTypes = EmploymentType::all();
        $contractTypes = ContractType::all();
        $contract = Contract::with('employee', 'contractType', 'employmentType')->findOrFail($id);
        return view('contracts.edit', compact('contract', 'employees', 'employmentTypes', 'contractTypes'));
    }
    public function update(Request $request, $id) {
        // Check validate
        // $messages = [
        //     'contract_id.required' => 'Mã hợp đồng là bắt buộc.',
        //     'contract_type_id.required' => 'Loại hợp đồng là bắt buộc.',
        //     'employment_type_id.required' => 'Loại hình công việc là bắt buộc.',
        //     'signing_date.required' => 'Ngày ký kết là bắt buộc.',
        //     'date_start.required' => 'Ngày bắt đầu là bắt buộc.',
        //     'date_end.required' => 'Ngày kết thúc là bắt buộc.',
        //     'gross_salary.required' => 'Lương gộp là bắt buộc.',
        //     'insurance_salary.required' => 'Lương bảo hiểm là bắt buộc.',
        //     // 'file_path.mimes' => 'Định dạng file phải là png hoặc pdf.',
        // ];

        // $validator = Validator::make($request->all(), [
        //     'employee_id' => 'required',
        //     'contract_id' => 'required',
        //     'contract_type_id' => 'required',
        //     'employment_type_id' => 'required',
        //     'signing_date' => 'required|date',
        //     'date_start' => 'required|date',
        //     'date_end' => 'required|date',
        //     'gross_salary' => 'required|numeric',
        //     'insurance_salary' => 'required|numeric',
        //     // 'file_path' => 'sometimes|mimes:png,pdf',
        // ], $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $contract = Contract::findOrFail($id);
        $contract->employee_id = $request->input('employee_id');
        $contract->contract_id = $request->input('contract_id');
        $contract->contract_type_id = $request->input('contract_type_id');
        $contract->contract_duration = $request->input('contract_duration');
        $contract->employment_type_id = $request->input('employment_type_id');
        $contract->signing_date = $request->input('signing_date');
        $contract->date_start = $request->input('date_start');
        $contract->date_end = $request->input('date_end');
        $contract->gross_salary = $request->input('gross_salary');
        $contract->insurance_salary = $request->input('insurance_salary');

        if ($request->hasFile('file_path')) {
            
            $generatedFileName = 'file_' . time() . '_' . $request->contract_id . '.' . $request->file('file_path')->getClientOriginalExtension();
            
            $request->file('file_path')->move(public_path('files'), $generatedFileName);
            
            $contract->file_path =  $generatedFileName;
        }

        $contract->note = $request->input('note');
        $contract->save();
        return redirect('/contracts');
    }

    public function destroy($id) {
        $contract = Contract::find($id);
        $contract->delete();
        return redirect('/contracts');
    }
    
    public function renew($id, Request $request)
    {

        $contract = Contract::findOrFail($id);
        $contract->date_end = $request->input('extension_date');
        $contract->status = true;  
        $contract->save();
        return redirect('/contracts');
    }

    public function terminate($id, Request $request)
    {
        $contract = Contract::findOrFail($id);

        $contract->date_end = now();
        $contract->status = false;
        $contract->save();
        return redirect('/contracts');
    }

    public function chart() {
        $contractCounts = $this->getContractCounts();
    
        $contractsExpiringIn15DaysGets = $this->getContractsExpiringInDaysGets(15);
        $contractsExpiringIn15Days = $contractsExpiringIn15DaysGets->count();
    
        $contractsExpiringIn30DaysGets = $this->getContractsExpiringInDaysGets(30);
        $contractsExpiringIn30Days = $contractsExpiringIn30DaysGets->count();
    
        $contractsExpiringIn45DaysGets = $this->getContractsExpiringInDaysGets(45);
        $contractsExpiringIn45Days = $this->getContractsExpiringInDays(45);
        // dd($contractsExpiringIn45DaysGets);
        
        $employeesWithoutContracts = $this->getEmployeesWithoutContracts();
        $employeesWithoutContractsCount = $employeesWithoutContracts->count();
    
        $expiredContracts = $this->getExpiredContracts();
        // dd($expiredContracts);
        $expiredContractsCount = $expiredContracts->count();
    
        return view('contracts.chart', compact(
            'contractCounts', 
            'contractsExpiringIn30Days', 
            'contractsExpiringIn45Days', 
            'contractsExpiringIn15Days', 
            'employeesWithoutContracts', 
            'employeesWithoutContractsCount', 
            'expiredContractsCount', 
            'expiredContracts',
            'contractsExpiringIn15DaysGets',
            'contractsExpiringIn45DaysGets', 
            'contractsExpiringIn30DaysGets'
        ));
    }
    
    private function getContractCounts() {
        return Contract::select('contract_type.contract_type_name', DB::raw('COUNT(*) as count'))
            ->leftJoin('contract_type', 'contracts.contract_type_id', '=', 'contract_type.contract_type_id')
            ->groupBy('contract_type.contract_type_name')
            ->get();
    }
    
    private function getContractsExpiringInDaysGets($days) {
        return DB::table('contracts')
            ->select('contracts.*', 'employees.*', 'contract_type.contract_type_name') // Chọn tất cả cột từ contracts và employees
            ->join('employees', 'contracts.employee_id', '=', 'employees.employee_id')
            ->join('contract_type', 'contracts.contract_type_id', '=', 'contract_type.contract_type_id')
            ->where('contracts.date_end', '>=', DB::raw('NOW()'))
            ->where('contracts.date_end', '<=', DB::raw('DATE_ADD(NOW(), INTERVAL ' . $days . ' DAY)'))
            ->get();
    }
    
    private function getContractsExpiringInDays($days) {
        return DB::table('contracts')
            ->where('date_end', '>=', DB::raw('NOW()'))
            ->where('date_end', '<=', DB::raw('DATE_ADD(NOW(), INTERVAL ' . $days . ' DAY)'))
            ->count();
    }
    
    private function getEmployeesWithoutContracts() {
        return Employee::whereDoesntHave('contracts')->get();
    }
    
    private function getExpiredContracts() {
        return Contract::select('contracts.*', 'employees.*', 'contract_type.contract_type_name')
                ->join('employees', 'contracts.employee_id', '=', 'employees.employee_id')
                ->join('contract_type', 'contracts.contract_type_id', '=', 'contract_type.contract_type_id')
                ->where('contracts.date_end', '<', now())
                ->get();
    }



    
    // public function sendContractExpiryNotification() {
    //     $contractsExpiringIn15DaysGets = DB::table('contracts')
    //                     ->join('employees', 'contracts.employee_id', '=', 'employees.employee_id')
    //                     ->select('contracts.*', 'employees.*')
    //                     // ->select('employees.employee_id', 'employees.employee_name', 'contracts.date_end')
    //                     ->where('contracts.date_end', '>=', DB::raw('NOW()'))
    //                     ->where('contracts.date_end', '<=', DB::raw('DATE_ADD(NOW(), INTERVAL 15 DAY)'))
    //                     ->get();
    //     foreach ($contractsExpiringIn15DaysGets as $contract) {
    //         $employeeEmail = $contract->email;
    //         $employeeName = $contract->employee_name;
    //         $dateEnd = $contract->date_end;

    //         Mail::send('contracts.email', ['employee_name' => $employeeName, 'date_end' => $dateEnd], function ($message) use ($employeeEmail, $employeeName) {
    //             $message->to($employeeEmail, $employeeName)
    //                 ->subject('Contract Expiry Notification');
    //         });
    //     }
                    
    //     dd($contractsExpiringIn15DaysGets);
    // }
    
}
