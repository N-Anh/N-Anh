@extends('layout.app')
@section('content')
	<section class="home-section">
		
		<div class="home-content">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-12">
					<h2>Tất cả hợp đồng</h2>
				</div>
				<div class="col-lg-4 col-md-5 col-6">
                    <form class="form-search" action="{{ route('contracts.index') }}" method="GET">
                        <input class="form-control" id="searchInput" type="text" name="search" value="{{ $search }}" placeholder="Tìm kiếm trong danh sách hợp đồng">
						<i id="clearSearch" class='bx bx-x'></i>
                    </form>
                </div>
				<div class="col-lg-3 col-md-3 col-6 d-flex justify-content-end">
					<a href="/contracts/create">
						<button class="btn-save py-2 px-2">Thêm hợp đồng</button>
					</a>
				</div>
			</div>
			<div class="row table-container mt-3 mx-1">
				<div class="scrollspy-table bg-body-tertiary p-0 rounded-2" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
					<table id="example" class="table table-striped table-hover nowrap">
						<thead>
							<tr>
								<th scope="col">Số hợp đồng</th>
								<th scope="col">Ngày ký hợp đồng</th>
								<th scope="col">Họ và tên NV</th>
								<th scope="col">Loại hợp đồng</th>
								<th scope="col">Thời hạn hợp đồng</th>
								<th scope="col">Ngày có hiệu lực</th>
								<th scope="col">Ngày hết hạn</th>
								<th scope="col">Lương cơ bản</th>
								<th scope="col">Lương đóng bảo hiểm</th>
								<th scope="col">Trạng thái hợp đồng</th>
							</tr>
						</thead>
						<tbody id="dataTable">
							@foreach ($contracts as $contract)
							<tr class="product-row">
								<td><a class="nav-link" href="/contracts/{{ $contract->id }}">{{ $contract->contract_id }}</a></td>
								<td>{{ \Carbon\Carbon::parse($contract->signing_date)->format('d-m-Y') }}</td>
								<td>{{ $contract->employee->employee_name }}</td>
								<td>{{ $contract->contractType->contract_type_name}}</td>
								<td>{{ $contract->contract_duration }}</td>
								<td>{{ \Carbon\Carbon::parse($contract->date_start)->format('d-m-Y') }}</td>
								<td>{{ \Carbon\Carbon::parse($contract->date_end)->format('d-m-Y') }}</td>
								<td>{{ number_format($contract->gross_salary, 0, ',', '.') }} VND</td>
								<td>{{ number_format($contract->insurance_salary, 0, ',', '.') }} VND</td>
								<td>{{ $contract->status ? 'Có hiệu lực' : 'Hết hạn' }}</td>
								<td>
									<div class="overlay justify-content-end">
										<i class='bx bx-dots-horizontal-rounded showBox'></i>
										<div class="action-menu">
											<div class="col-5 p-0 m-0 d-grid">
												<a class="nav-link d-grid" href="contracts/{{ $contract->id }}/edit">
													<button class="px-3 m-0 py-2 d-flex">Sửa</button>
												</a>
												<button onclick="confirmDelete(event, {{ $contract->id }})" class="px-3 m-0 py-2 d-flex">Xóa </button>
												<div id="confirmDialog{{ $contract->id }}" class="overlay-noti">
													<div class="confirm-delete">
														<p class="text-center">Bạn có muốn xóa hợp đồng {{ $contract->contract_id }} không?</p>
														<div class="row justify-content-center">
															<button class="button-cancel p-2 col-3 mx-1" onclick="cancelDelete({{ $contract->id }})">Hủy</button>
															<form class="col-3 mx-1 d-grid p-0" action="/contracts/{{ $contract->id }}" method="POST">
																@csrf
																@method('delete')
																<button class="bg-danger col-12 p-2 justify-content-center">
																	Đồng ý
																</button>
															</form>
														</div>
													</div>
												</div>
												<button onclick="confirmRenew(event, {{ $contract->id }})" class="px-3 m-0 py-2 d-flex">Gia hạn hợp đồng</button>
												<div id="confirmRenew{{ $contract->id }}" class="overlay-noti">
													<div class="confirm-renew">
														<div class="row">

															<p class="text-center ">Bạn có muốn gia hạn hợp đồng {{ $contract->contract_id }} không?</p>
														</div>
														<div class="">
															<form class="row justify-content-center" action="/contracts/{{ $contract->id }}" method="POST">
																@csrf
																<div class="row">
																	<label class="col-5 ps-0 text-start" for="extension_date">Gia hạn đến ngày: </label>
																	<input  type="date" id="extension_date" class="form-control col" name="extension_date" required>
																</div>
																<div class="row d-flex justify-content-end mt-3">
																	<button class="button-cancel p-2 col-3 mx-1" onclick="cancelRenew({{ $contract->id }})">Hủy</button>
																	<button onclick="confirmRenew(event, {{ $contract->id }})" type="submit" class="bg-danger p-2 col-3 justify-content-center">
																		Gia hạn
																	</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<button onclick="confirmEnd(event, {{ $contract->id }})" class="px-3 m-0 py-2 d-flex">Chấm dứt hợp đồng</button>
												<div id="confirmEnd{{ $contract->id }}" class="overlay-noti">
													<div class="confirm-end">
														<div class="row">

															<p class="text-center">Bạn có muốn chấm dứt hợp đồng {{ $contract->contract_id }} không?</p>
														</div>
														<div class="row justify-content-center">
															<button class="button-cancel p-2 col-3 mx-1" onclick="cancelEnd({{ $contract->id }})">Hủy</button>
															<form class="col-3 mx-1 d-grid" action="{{ route('contracts.terminate', $contract->id) }}" method="POST">
																@csrf
																<button type="submit" class="bg-danger col-12 p-2 justify-content-center">
																	Chấm dứt
																</button>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="row mt-3">
                {{ $contracts->appends(['search' => $search])->links() }}
            </div>
		</div>
		<script>
			const clearIcon = document.getElementById('clearSearch');
			clearIcon.addEventListener('click', function() {
				const searchInput = document.getElementById('searchInput');
				searchInput.value = '';
				window.location.href = '/contracts';
			});
            let searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                let searchValue = this.value.trim();

                if (searchValue === '') {
                    window.location.href = '/contracts';
                }
            });
		</script>
	</section>	
@endsection