@extends('layout.app')
@section('content')
		<section class="home-section">
			<div>
				<div class="row my-3 pe-3">
					<div class="col-lg-9 col-md-9 col-12 d-flex">
						<a href="{{ url()->previous() }}">
							<i class='bx bx-left-arrow-alt'></i>
						</a>
						<h4 class="col oneLine">  Hợp đồng {{ $contract->contract_id }} - NV {{ $contract->employee->employee_name }}</h4>
					</div>
					<div class="col-lg-3 col-md-3 col-12 d-flex justify-content-end">
						<a class="nav-link col-lg-6 col-md-6 col-3  d-grid" href="{{ $contract->id }}/edit">
							<button class="btn-cancel px-3 py-2 mx-1">Sửa</button>
						</a>
						
						<a class="nav-link col-lg-6 col-md-6 col-3  d-grid" href="">
							<button onclick="confirmDel(event, id)" class="btn-cancel px-3 py-2 mx-1">Xóa</button>
						</a>
						<div id="confirmDialog" class="overlay-noti">
							<div class="confirm-delete ">
								<p class="text-center">Bạn có muốn xóa hợp đồng {{ $contract->contract_id }} không?</p>
								<div class="row justify-content-center">
									<button class="button-cancel p-2 col-3 mx-1" onclick="cancelDelete(id)">Hủy</button>
									<form class="col-3 mx-1 d-grid" action="/contracts/{{ $contract->id }}" method="POST">
										@csrf
										@method('delete')
										<button class="bg-danger row p-2 justify-content-center" onclick="deleteItem()">
											Đồng ý
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="scrollspy-table bg-body-tertiary p-5 rounded-2 " data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12  d-flex">
							<div class="col-5">Mã nhân viên: </div>
							<div class="col-7 detail-content">{{ $contract->employee_id }}</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Họ và tên NV:</div>
							<div class="col-7 detail-content">{{ $contract->employee->employee_name }}</div>
						</div>
					</div>
					<div class="row mt-lg-4 mt-md-4 mt-0">
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Số hợp đồng:</div>
							<div class="col-7 detail-content">{{ $contract->contract_id }}</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Ngày ký: </div>
							<div class="col-7 detail-content">{{ \Carbon\Carbon::parse($contract->signing_date)->format('d-m-Y') }}</div>
						</div>
					</div>
					<div class="row mt-lg-4 mt-md-4 mt-0">
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Loại hợp đồng:</div>
							<div class="col-7 detail-content">{{ $contract->contractType->contract_type_name }}</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Thời hạn hợp đồng: </div>
							<div class="col-7 detail-content">{{ $contract->contract_duration }}</div>
						</div>
					</div>
					<div class="row mt-lg-4 mt-md-4 mt-0">
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Ngày có hiệu lực: </div>
							<div class="col-7 detail-content">{{ \Carbon\Carbon::parse($contract->date_start)->format('d-m-Y') }}</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Ngày hết hạn: </div>
							<div class="col-7 detail-content">{{ \Carbon\Carbon::parse($contract->date_end)->format('d-m-Y') }}</div>
						</div>
					</div>
					<div class="row mt-lg-4 mt-md-4 mt-0">
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Lương cơ bản: </div>
							<div class="col-7 detail-content">{{ number_format($contract->gross_salary, 0, ',', '.') }} VND</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Lương đóng bảo hiểm: </div>
							<div class="col-7 detail-content">{{ number_format($contract->insurance_salary, 0, ',', '.') }} VND</div>
						</div>
					</div>
					<div class="row mt-lg-4 mt-md-4 mt-0">
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Hình thức làm việc: </div>
							<div class="col-7 detail-content">{{ $contract->employmentType->employment_type_name }}</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Ghi chú: </div>
							<div class="col-7 detail-content">{{ $contract->note ? $contract->note : "--" }}</div>
						</div>
					</div>
					<div class="row mt-lg-4 mt-md-4 mt-0">
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Tệp đính kèm: </div>
							<div class="col-7 detail-content">
								@if($contract->file_path)
									<a class="nav-link" href="{{ asset('files/' . $contract->file_path) }}" download>{{ $contract->file_path }}</a>
								@else
									--
								@endif
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-4 d-flex">
							<div class="col-5">Trạng thái hợp đồng: </div>
							<div class="col-7 detail-content">{{ $contract->status ? 'Có hiệu lực' : 'Hết hạn' }}</div>
						</div>
						
					</div>
					
				</div>
			</div>
			
		</section>
@endsection