<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendContractExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:contract-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to employees whose contracts are expiring within 15 days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Log::info('Command is running');
            $contractsExpiringIn15Days = DB::table('contracts')
                ->join('employees', 'contracts.employee_id', '=', 'employees.employee_id')
                ->select('contracts.*', 'employees.employee_name', 'employees.email')
                ->where('contracts.date_end', '>=', now())
                ->where('contracts.date_end', '<=', now()->addDays(15))
                ->get();

            foreach ($contractsExpiringIn15Days as $contract) {
                $employeeEmail = $contract->email;
                $employeeName = $contract->employee_name;
                $contractId = $contract->contract_id;
                $dateEnd = Carbon::parse($contract->date_end)->format('d/m/Y');

                Mail::send('contracts.email', ['employee_name' => $employeeName, 'date_end' => $dateEnd, 'contract_id' => $contractId], function ($message) use ($employeeEmail, $employeeName) {
                    $message->to($employeeEmail, $employeeName)
                        ->subject('Thông báo hợp đồng sắp hết hạn');
                });
            }

            $this->info('Contract expiry notifications have been sent successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            return 1;
        }

        return 0; 
    }
}
