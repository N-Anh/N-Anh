@extends('layout.app')
@section('content')
<section class="home-section">
    <div class="home-content">
        <div class="container-fluid">
            <div class="row">
                <h2>Thêm hợp đồng</h2>
            </div>
            <form action="/contracts" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row scrollspy bg-body-tertiary p-3 rounded-2" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="nameEmployee">Họ và tên người lao động <span>*</span> </label>
                            <input name="employee_name" list="employees" id="nameEmployee" class="form-control" placeholder="Họ và tên người lao động" value="{{ old('employee_name') }}">
                            @error('employee_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" id="employeeId" name="employee_id" style="display:none;" value="{{ old('employee_id') }}">
                            <datalist id="employees">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_name }}" data-id="{{ $employee->employee_id }}">
                                        {{ $employee->employee_name }} - {{ $employee->employee_id }}
                                    </option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="employeeCode">Mã nhân viên <span>*</span> </label>
                            <input type="text" id="employeeCode" class="form-control" placeholder="Mã nhân viên" value="{{ old('employee_id') }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="contractNumber">Số hợp đồng <span>*</span> </label>
                            <input name="contract_id" type="text" id="contractNumber" class="form-control" placeholder="Số hợp đồng" value="{{ old('contract_id') }}">
                            @error('contract_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="typeContract">Loại hợp đồng <span>*</span> </label>
                            <select name="contract_type_id" id="typeContract" class="form-select">
                                <option value="" selected>Loại hợp đồng</option>
                                @foreach ($contractTypes as $contractType)
                                    <option value="{{ $contractType->contract_type_id }}" {{ old('contract_type_id') == $contractType->contract_type_id ? 'selected' : '' }}>
                                        {{ $contractType->contract_type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('contract_type_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="typeContract">Thời hạn hợp đồng</label>
                            <input name="contract_duration" type="text" id="duration" class="form-control" list="duration-options" placeholder="Thời hạn hợp đồng" value="{{ old('contract_duration') }}">
                            <datalist id="duration-options">
                                <option value="1 tháng"></option>
                                <option value="3 tháng"></option>
                                <option value="6 tháng"></option>
                                <option value="1 năm"></option>
                                <option value="2 năm"></option>
                                <option value="3 năm"></option>
                            </datalist>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="workForm">Hình thức làm việc</label>
                            <select name="employment_type_id" id="workForm" class="form-select">
                                <option selected>Hình thức làm việc</option>
                                @foreach ($employmentTypes as $employmentType)
                                    <option value="{{ $employmentType->employment_type_id }}" {{ old('employment_type_id') == $employmentType->employment_type_id ? 'selected' : '' }}>
                                        {{ $employmentType->employment_type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="signDate">Ngày ký hợp đồng <span>*</span> </label>
                            <input name="signing_date" type="date" id="signDate" class="form-control" placeholder="Ngày ký hợp đồng" value="{{ old('signing_date') }}">
                            @error('signing_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="effectiveDate">Ngày có hiệu lực <span>*</span> </label>
                            <input name="date_start" type="date" id="effectiveDate" class="form-control" placeholder="Ngày có hiệu lực" value="{{ old('date_start') }}">
                            @error('date_start')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="expirationDate">Ngày hết hạn <span>*</span> </label>
                            <input name="date_end" type="date" id="expirationDate" class="form-control" placeholder="Ngày hết hạn" value="{{ old('date_end') }}">
                            @error('date_end')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="basicSalary">Lương cơ bản <span>*</span> </label>
                            <input name="gross_salary" type="text" id="basicSalary" class="form-control" placeholder="Lương cơ bản" value="{{ old('gross_salary') }}">
                            @error('gross_salary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="insuranceSalary">Lương đóng bảo hiểm <span>*</span> </label>
                            <input name="insurance_salary" type="text" id="insuranceSalary" class="form-control" placeholder="Lương đóng bảo hiểm" value="{{ old('insurance_salary') }}">
                            @error('insurance_salary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="formFile" class="form-label">Tệp đính kèm </label>
                            <div class="row m-0 input-flie">
                                <input class="form-control" type="text" id="fileName" readonly>
                                <button type="button" class="p-0" onclick="document.getElementById('realUpload').click()">
                                    <i class='bx bx-cloud-upload'></i>
                                </button>
                                <input name="file_path" type="file" id="realUpload" style="display:none" onchange="updateFileName(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label class="py-2" for="note">Ghi chú</label>
                            <input name="note" type="text" id="note" class="form-control" placeholder="Ghi chú" value="{{ old('note') }}">
                        </div>
                    </div>
                </div>
                <div class="row mt-4 px-4 justify-content-end mt-3">
                    <button class="col-lg-2 col-md-2 col-5 py-2 btn-cancel"><a class="nav-link" href="{{ url()->previous() }}">Hủy</a></button>
                    <button type="submit" class="col-lg-2 col-md-2 col-5 py-2 mx-lg-2 mx-lg-2 mx-md-2 ms-2 btn-save">Lưu</button>
                    {{-- <button class="col-lg-2 col-md-2 col-6 py-2 btn-save-and-add mt-lg-0 mt-md-0 mt-3">Lưu và thêm</button> --}}
                </div>
            </form>
            
        </div>
        
    </div>
    @if ($error)
        <div class="alert-container">
            <div class="alert alert-danger" role="alert">
                <div class="row d-flex justify-content-between">
                    <h6 class="text-start col-6">Thông báo</h6>
                    <i class="bx bx-x col-1 me-2"></i> 
                </div>
                <p class="text-start">{{ $error }}</p>
                {{-- <div class="row justify-content-end" >
                    <button class="col-3 py-2 mx-1 btn-cancel">Hủy</button>
                    <button class="col-3 py-2 mx-1 btn-save">Đồng ý</button>
                </div> --}}
            </div>
        </div>
    @endif
</section>
@endsection
