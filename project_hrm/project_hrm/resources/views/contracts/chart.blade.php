<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<title> Đồ án </title>
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chart.css') }}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

    </style>
</head>

<body>
	<div>
		<div class="top-menu row mx-0">
			<div class="logo-details col-lg-4 col-md-4 col-2 d-flex align-items-center px-0">
				<i class='bx bx-grid-alt show-sidebar'></i>
				<span class="logo_name">Quản lý nhân sự</span>
			</div>
			<div class="col-5 d-flex align-items-center position-relative px-0">
				<input class="form-control" type="text" placeholder="Tìm kiếm">
				<button class="btn-search py-0">
					<i class='bx bx-search'></i>
				</button>
			</div>
			<div class="col-lg-3 col-md-3 col-5 d-flex justify-content-end align-items-center info">
				<i class='bx bx-bell'></i>
				<i class='bx bx-help-circle px-3' ></i>
				<div class="avatar pe-3">
					<img src="{{ asset('img/avt.png') }}" alt="">
				</div>
			</div>
		</div>
		<div class="sidebar close">
			<div class="position-relative">

				<ul class="nav-links">
					<li>
						<a href="#">
							<i class='bx bx-home-alt' ></i>
							<span class="link_name">Tổng quan</span>
						</a>
						<ul class="sub-menu blank">
							<li><a class="link_name" href="#">Tổng quan</a></li>
						</ul>
					</li>
					<li>
						<div class="iocn-link">
							<a href="#">
								<i class='bx bxs-user-account' ></i>
								<span class="link_name">Hệ thống</span>
							</a>
							<i class='bx bxs-chevron-down arrow'></i>
						</div>
						<ul class="sub-menu blank">
							<li><a class="link_name" href="#">Hệ thống</a></li>
						</ul>
					</li>
					<li>
						<div class="iocn-link">
							<a href="#">
								<i class='bx bx-user-plus'></i>
								<span class="link_name">Tuyển dụng</span>
							</a>
							<i class='bx bxs-chevron-down arrow'></i>
						</div>
						<ul class="sub-menu blank ">
							<li><a class="link_name" href="#">Tuyển dụng</a></li>
						</ul>
					</li>
					<li>
						<div class="iocn-link">
							<a href="#">
								<i class='bx bxs-user-detail'></i>
								<span class="link_name">Hồ sơ</span>
							</a>
							<i class='bx bxs-chevron-down arrow'></i>
						</div>
						<ul class="sub-menu blank">
							<li><a class="link_name" href="#">Hồ sơ</a></li>
						</ul>
					</li>
					<li>
						<div class="iocn-link">
							<a href="#">
								<i class='bx bx-file'></i>
								<span class="link_name">Hợp đồng</span>
							</a>
							<i class='bx bxs-chevron-down arrow'></i>
						</div>
						<ul class="sub-menu">
							<li><a class="link_name" href="/">Hợp đồng</a></li>
							<li><a href="/contracts">Tất cả hợp đồng</a></li>
							<li><a href="/contracts/create">Thêm hợp đồng</a></li>
						</ul>
					</li>
					<li>
						<div class="iocn-link">
							<a href="#">
								<i class='bx bx-calendar'></i>
								<span class="link_name">Chấm công</span>
							</a>
							<i class='bx bxs-chevron-down arrow'></i>
						</div>
						<ul class="sub-menu blank">
							<li><a class="link_name" href="#">Chấm công</a></li>
						</ul>
					</li>
					<li>
						<div class="iocn-link">
							<a href="#">
								<i class='bx bx-calculator' ></i>
								<span class="link_name">Lương</span>
							</a>
							<i class='bx bxs-chevron-down arrow'></i>
						</div>
						<ul class="sub-menu blank">
							<li><a class="link_name" href="#">Lương</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<section class="home-section">
			<div class="home-content">
                <div class="row px-3">
                    <div class=" col-4 p-2 card card-chart">
                        <canvas id="contractChart"></canvas>
                    </div>
                    <div class="col-2 card card-noti ms-3">
                        <div class="row p-2">
                                <p class="title">Hợp đồng sắp hết hạn</p>
                                <select id="select-date" class="form-select">
                                    <option value="15">15 ngày</option>
                                    <option value="30" selected>30 ngày</option>
                                    <option value="45">45 ngày</option>
                                </select>
                        </div>
                        <div class="row nearing-expiration">
                            <h3 class="text-center display-report" id="count" onclick="openModal()">{{ $contractsExpiringIn30Days }}</h3>
                        </div>
                        <div id="overlayContractsExpiring" class="overlay"></div>

                        <div id="modalContractsExpiring" class="modal">
                            <div class="row d-lfex justify-content-between">
                                <h4 class="col-10">Danh sách nhân viên sắp hết hạn hợp đồng</h4>
                                <div class="col-1 d-flex justify-content-end pe-0">
                                    <i class='bx bx-x close-button'></i>
                                </div>
                                {{-- <a href="{{ url('/export-employees-without-contracts') }}" class="btn btn-success col-1">Export Excel</a> --}}
                            </div>
                            <div class="row justify-content-end">
                                <button class="px-2 my-2 me-3 d-flex justity-content-center align-items-center btn-export py-2 px-0">
                                    <i class='bx bxs-file-export pe-2'></i>
                                    Xuất khẩu
                                </button>
                            </div>
                            <div class="scrollspy-table-export bg-body-tertiary p-0 rounded-2" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
                                <table id="example" class="table table-striped table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ngày ký hợp đồng</th>
                                            <th scope="col">Số hợp đồng</th>
                                            <th scope="col">Mã nhân viên</th>
                                            <th scope="col">Họ và tên nhân viên</th>
                                            <th scope="col">Loại hợp đồng</th>
                                            <th scope="col">Thời hạn hợp đồng</th>
                                            <th scope="col">Ngày có hiệu lực</th>
                                            <th scope="col">Ngày hết hạn</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contractsList">
                                        <!-- Hợp đồng hiển thị bằng JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-secondary mt-3 ">Tổng số bản ghi: <span class="total-record"></span></p>
                        </div>
                    </div>
                    <div class="col-2 card card-noti ms-3 p-2">
                        <div class="row">
                            <p class="title">Nhân viên chưa có hợp đồng</p>
                        </div>
                        <div class="row employee-contract">
                            <h3 id="employeesWithoutContractsCount" class="text-center display-report">{{ $employeesWithoutContractsCount }}</h3>
                        </div>
                        <div id="overlayEmployees" class="overlay"></div>
                        
                        <div id="modalEmployees" class="modal">
                            <div class="row d-lfex justify-content-between">
                                <h4 class="col-10">Danh sách nhân viên chưa có hợp đồng</h4>
                                <div class="col-1 d-flex justify-content-end pe-0">
                                    <i class='bx bx-x close-button'></i>
                                </div>
                                {{-- <a href="{{ url('/export-employees-without-contracts') }}" class="btn btn-success col-1">Export Excel</a> --}}
                            </div>
                            <div class="row justify-content-end">
                                <button class="px-2 my-2 me-3 d-flex justity-content-center align-items-center btn-export py-2 px-0">
                                    <i class='bx bxs-file-export pe-2'></i>
                                    Xuất khẩu
                                </button>
                            </div>
                            <div class="scrollspy-table-export bg-body-tertiary p-0 rounded-2" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
                                <table id="example" class="table table-striped table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã nhân viên</th>
                                            <th scope="col">Họ và tên nhân viên</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employeesWithoutContracts as $employee)
                                        <tr>
                                            <td>{{ $employee->employee_id }}</td>
                                            <td>{{ $employee->employee_name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-secondary mt-3">Tổng số bản ghi: {{ $employeesWithoutContractsCount }}</p>
                        </div>
                    </div>
                    <div class="col-2 card card-noti ms-3 p-2">
                        <div class="row">
                            <p class="title">Số hợp đồng hết hạn</p>
                        </div>
                        <div class="row expired">
                            <h3 id="expiredContractsCount" class="text-center display-report">{{ $expiredContractsCount }}</h3>
                        </div>
                        <div id="overlayExpired" class="overlay"></div>
                    
                        <div id="modalExpired" class="modal">
                            <div class="row d-lfex justify-content-between">
                                <h4 class="col-10">Danh sách hợp đồng hết hạn</h4>
                                <div class="col-1 d-flex justify-content-end pe-0">
                                    <i class='bx bx-x close-button'></i>
                                </div>
                                {{-- <a href="{{ url('/export-employees-without-contracts') }}" class="btn btn-success col-1">Export Excel</a> --}}
                            </div>
                            <div class="row justify-content-end">
                                <button class="px-2 my-2 me-3 d-flex justity-content-center align-items-center btn-export py-2 px-0">
                                    <i class='bx bxs-file-export pe-2'></i>
                                    Xuất khẩu
                                </button>
                            </div>
                            <div class="scrollspy-table-export bg-body-tertiary p-0 rounded-2" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
                                <table id="example" class="table table-striped table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ngày ký hợp đồng</th>
                                            <th scope="col">Số hợp đồng</th>
                                            <th scope="col">Mã nhân viên</th>
                                            <th scope="col">Họ và tên nhân viên</th>
                                            <th scope="col">Loại hợp đồng</th>
                                            <th scope="col">Thời hạn hợp đồng</th>
                                            <th scope="col">Ngày có hiệu lực</th>
                                            <th scope="col">Ngày hết hạn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expiredContracts as $contract)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($contract->signing_date)->format('d-m-Y') }}</td>
                                            <td>{{ $contract->contract_id }}</td>
                                            <td>{{ $contract->employee->employee_id }}</td>
                                            <td>{{ $contract->employee->employee_name }}</td>
                                            <td>{{ $contract->contract_type_name }}</td>
                                            <td>{{ $contract->contract_duration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contract->date_start)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contract->date_end)->format('d-m-Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-secondary mt-3">Tổng số bản ghi: {{ $expiredContractsCount }}</p>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
		</section>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- <script src="{{ asset('js/chart.js') }}"></script> --}}
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
        var ctx = document.getElementById('contractChart').getContext('2d');
        var contractCounts = @json($contractCounts);
        var data = {
            labels: [],
            datasets: [{
                label: 'Hợp đồng',
                data: [],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        var totalContracts = 0;
        contractCounts.forEach(function (item) {
            data.labels.push(item.contract_type_name);
            data.datasets[0].data.push(item.count);
            totalContracts += item.count;
        });

        var options = {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 10,
                        generateLabels: function (chart) {
                            var data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function (label, i) {
                                    var dataset = data.datasets[0];
                                    var percent = ((dataset.data[i] / totalContracts) * 100).toFixed(2) + '%';
                                    return {
                                        text: label + ' - ' + dataset.data[i] + ' (' + percent + ')',
                                        fillStyle: dataset.backgroundColor[i],
                                        hidden: isNaN(dataset.data[i]) || chart.getDatasetMeta(0).data[i].hidden,
                                        index: i
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            var label = context.label || '';
                            if (context.parsed.y !== null) {
                                var dataset = context.dataset;
                                var total = dataset.data.reduce((a, b) => a + b, 0);
                                var currentValue = dataset.data[context.dataIndex];
                                var percentage = ((currentValue / total) * 100).toFixed(2) + '%';
                                label += ' - ' + currentValue + ' (' + percentage + ')';
                            }
                            return label;
                        }
                    }
                }
            }
        };

        var contractChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
    </script>
	<script>
        const contractsExpiringIn30Days = {{ $contractsExpiringIn30Days }};
        const contractsExpiringIn45Days = {{ $contractsExpiringIn45Days }};
        const contractsExpiringIn15Days = {{ $contractsExpiringIn15Days }};
        document.getElementById('select-date').addEventListener('change', function() {
            const selectElement = document.getElementById('select-date');
            const headingElement = document.getElementById('count');
            const selectedValue = parseInt(selectElement.value);
            let count = 0;

            if (selectedValue === 30) {
                count = contractsExpiringIn30Days;
            } else if (selectedValue === 45) {
                count = contractsExpiringIn45Days;
            }
            else if (selectedValue === 15) {
                count = contractsExpiringIn15Days;
            }

            headingElement.textContent = count;
        });
        var modal = document.getElementById("myModal");
        function openModal() {
            modal.style.display = "block";
        }

        // Get modal elements
        var modalEmployees = document.getElementById("modalEmployees");
        var modalExpired = document.getElementById("modalExpired");

        // Get overlay elements
        var overlayEmployees = document.getElementById("overlayEmployees");
        var overlayExpired = document.getElementById("overlayExpired");

        // Get close button elements
        var closeButtons = document.querySelectorAll(".close-button");

        // Function to show modal and overlay
        function showModal(modal, overlay) {
            modal.style.display = "block";
            overlay.style.display = "block";
        }

        // Function to hide modal and overlay
        function hideModal(modal, overlay) {
            modal.style.display = "none";
            overlay.style.display = "none";
        }

        // Event listener for showing modals when clicking on h3
        document.getElementById("employeesWithoutContractsCount").addEventListener("click", function() {
            showModal(modalEmployees, overlayEmployees);
        });

        document.getElementById("expiredContractsCount").addEventListener("click", function() {
            showModal(modalExpired, overlayExpired);
        });

        // Event listener for closing modals when clicking on close button
        closeButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                hideModal(modalEmployees, overlayEmployees);
                hideModal(modalExpired, overlayExpired);
            });
        });
        // Function to open modalContractsExpiring and overlayContractsExpiring
        function openModal() {
            var modal = document.getElementById("modalContractsExpiring");
            var overlay = document.getElementById("overlayContractsExpiring");
            modal.style.display = "block";
            overlay.style.display = "block";
        }

        // Function to close modalContractsExpiring and overlayContractsExpiring
        function closeModal() {
            var modal = document.getElementById("modalContractsExpiring");
            var overlay = document.getElementById("overlayContractsExpiring");
            modal.style.display = "none";
            overlay.style.display = "none";
        }

        // Event listener for close button in modal
        document.querySelector("#modalContractsExpiring .close-button").addEventListener("click", function() {
            closeModal();
        });

        // Event listener for overlay click to close modal
        document.getElementById("overlayContractsExpiring").addEventListener("click", function() {
            closeModal();
        });

        function openModal() {
            var modal = document.getElementById("modalContractsExpiring");
            var overlay = document.getElementById("overlayContractsExpiring");
            modal.style.display = "block";
            overlay.style.display = "block";

            const selectValue = parseInt(document.getElementById('select-date').value);
            const contractsListElement = document.getElementById('contractsList');
            contractsListElement.innerHTML = '';
            const totalRecordElement = document.querySelector('.total-record');
            let contractsData = [];
            let totalRecords = 0;
            if (selectValue === 30) {
                contractsData = @json($contractsExpiringIn30DaysGets);
            } else if (selectValue === 45) {
                contractsData = @json($contractsExpiringIn45DaysGets);
            } else if (selectValue === 15) {
                contractsData = @json($contractsExpiringIn15DaysGets);
            }

            totalRecords = contractsData.length;
            if (totalRecordElement) {
                totalRecordElement.textContent = totalRecords;
            }

            contractsData.forEach(contract => {
                const row = document.createElement('tr');
                const signDateCell = document.createElement('td');
                signDateCell.textContent = formatDate(contract.signing_date, 'd-m-Y');
                const idCell = document.createElement('td');
                const idContractCell = document.createElement('td');
                idContractCell.textContent = contract.contract_id;
                idCell.textContent = contract.employee_id;

                const nameCell = document.createElement('td');
                nameCell.textContent = contract.employee_name;
                const contractTypeCell = document.createElement('td');
                contractTypeCell.textContent = contract.contract_type_name;

                const contractDurationCell = document.createElement('td');
                contractDurationCell.textContent = contract.contract_duration;
                const contractStartCell = document.createElement('td');
                contractStartCell.textContent = formatDate(contract.date_start, 'd-m-Y');
                const contractEndCell = document.createElement('td');
                contractEndCell.textContent = formatDate(contract.date_end, 'd-m-Y');

                row.appendChild(signDateCell);
                row.appendChild(idContractCell);
                row.appendChild(idCell);
                row.appendChild(nameCell);
                row.appendChild(contractTypeCell);
                row.appendChild(contractDurationCell);
                row.appendChild(contractStartCell);
                row.appendChild(contractEndCell);
                contractsListElement.appendChild(row);
            });
        }
        function formatDate(dateString, format) {
            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            const date = new Date(dateString);
            return date.toLocaleDateString('en-GB', options).replace(/\//g, '-');
        }
        // Function to close modalContractsExpiring and overlayContractsExpiring
        function closeModal() {
            var modal = document.getElementById("modalContractsExpiring");
            var overlay = document.getElementById("overlayContractsExpiring");
            modal.style.display = "none";
            overlay.style.display = "none";
        }

        // Event listener for close button in modal
        document.querySelector("#modalContractsExpiring .close-button").addEventListener("click", function() {
            closeModal();
        });

        // Event listener for overlay click to close modal
        document.getElementById("overlayContractsExpiring").addEventListener("click", function() {
            closeModal();
        });
</script>

</body>
</html>
