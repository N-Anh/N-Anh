@extends('layout.app')
@section('content')
	<section class="home-section">
		<div class="home-content">
			<div class="container-fluid">
				<div class="row my-3 pe-3">
					<div class="col-lg-9 col-md-9 col-12 d-flex">
						<a href="{{ url()->previous() }}">
							<i class='bx bx-left-arrow-alt'></i>
						</a>
						<h4 class="col oneLine">  Hợp đồng {{ $contract->contract_id }} - NV {{ $contract->employee->employee_name }}</h4>
					</div>
				</div>
                <form action="/contracts/{{ $contract->id }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('put')
                    <div class="row scrollspy bg-body-tertiary p-3 rounded-2" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="nameEmployee">Họ và tên người lao động <span>*</span> </label>
                                
								<select name="employee_id" id="nameEmployee" class="form-select" >
									<option value="{{ $contract->employee_id }}"> {{ $contract->employee->employee_name }} </option>
								</select>
								{{-- <label class="py-2" for="nameEmployee">Họ và tên người lao động <span>*</span> </label>
								<input name="employee_name" type="text" id="nameEmployee" class="form-control" placeholder="Mã nhân viên" disabled value="{{ $contract->employee->employee_name }}"> --}}
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="employeeCode">Mã nhân viên <span>*</span> </label>
                                <input  type="text" id="employeeCode" class="form-control" placeholder="Mã nhân viên" disabled value="{{ $contract->employee_id }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="contractNumber">Số hợp đồng <span>*</span> </label>
                                <input name="contract_id" type="text" id="contractNumber" class="form-control" placeholder="Số hợp đồng" value="{{ $contract->contract_id }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="typeContract">Loại hợp đồng <span>*</span> </label>
                                <select name="contract_type_id" id="typeContract" class="form-select">
                                    <option value="{{ $contract->contractType->contract_type_id }}" selected>{{ $contract->contractType->contract_type_name }}</option>
                                    @foreach ($contractTypes as $contractType)
                                        <option value="{{ $contractType->contract_type_id }}">
                                        {{ $contractType->contract_type_name }}
                                        </option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="typeContract">Thời hạn hợp đồng</label>
                                <input type="text" name="contract_duration" id="typeContract" class="form-control" placeholder="Thời hạn hợp đồng" value="{{ $contract->contract_duration }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="workForm">Hình thức làm việc</label>
                                <select name="employment_type_id" id="workForm" class="form-select">
                                    <option value="{{ $contract->employmentType->employment_type_id }}" selected>{{ $contract->employmentType->employment_type_name }}</option>
                                    @foreach ($employmentTypes as $employmentType)
                                        <option value="{{ $employmentType->employment_type_id }}">
                                        {{ $employmentType->employment_type_name }}
                                        </option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="signDate">Ngày ký hợp đồng <span>*</span> </label>
                                <input name="signing_date" type="date" id="signDate" class="form-control" placeholder="Ngày ký hợp đồng" value="{{ $contract->signing_date }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="effectiveDate">Ngày có hiệu lực <span>*</span> </label>
                                <input name="date_start" type="date" id="effectiveDate" class="form-control" placeholder="Ngày có hiệu lực" value="{{ $contract->date_start }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="expirationDate">Ngày hết hạn <span>*</span> </label>
                                <input name="date_end" type="date" id="expirationDate" class="form-control" placeholder="Ngày hết hạn" value="{{ $contract->date_end }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="basicSalary">Lương cơ bản <span>*</span> </label>
                                <input name="gross_salary" type="text" id="basicSalary" class="form-control" placeholder="Lương cơ bản" value="{{ number_format($contract->gross_salary, 0, '', '')  }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="insuranceSalary">Lương đóng bảo hiểm <span>*</span> </label>
                                <input name="insurance_salary" type="text" id="insuranceSalary" class="form-control" placeholder="Lương đóng bảo hiểm" value="{{ number_format($contract->gross_salary, 0, '', '') }}">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" class="form-label">Tệp đính kèm </label>
								<div class="row m-0 input-flie">
										<input  class="form-control" type="text" id="fileName" value="{{ $contract->file_path }}" readonly>
										<button type="button" class="p-0" onclick="document.getElementById('realUpload').click()">
											<i class='bx bx-cloud-upload' ></i>
										</button>
									<input name="file_path" type="file" id="realUpload" style="display:none" onchange="updateFileName(this)">
								</div>
                                {{-- <div class="input-group mb-3">
                                    <input name="file_path" class="form-control" type="file" id="formFile" value="{{ $contract->file_path }}">
                                </div> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                                <label class="py-2" for="note">Ghi chú</label>
                                <input name="note" type="text" id="note" class="form-control" placeholder="Ghi chú" value="{{ $contract->note }}">
                            </div>
                        </div>
					</div>
                    <div class="row mt-4 px-4 justify-content-end mt-3">
                        <button class="col-lg-2 col-md-2 col-5 py-2 btn-cancel"><a class="nav-link" href="{{ url()->previous() }}">Hủy</a></button>
                        <button type="submit" class="col-lg-2 col-md-2 col-5 py-2 mx-lg-2 mx-lg-2 mx-md-2 ms-2 btn-save">Lưu</button>
                    </div>
                </form>
			</div>
		</div>
	</section>
@endsection
	