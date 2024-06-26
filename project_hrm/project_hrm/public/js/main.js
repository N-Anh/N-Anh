let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement;
    arrowParent.classList.toggle("showMenu");
  });
}

// show and hide sidebar
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".show-sidebar");
sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
})

// show and hide active menu ở list contract
document.querySelectorAll('.showBox').forEach(item => {
  item.addEventListener('click', event => {
    event.stopPropagation(); // Ngăn sự kiện click lan ra ngoài
    const actionMenu = item.closest('.overlay').querySelector('.action-menu');
    actionMenu.style.display = (actionMenu.style.display === 'block') ? 'none' : 'block';
  });
});
document.addEventListener('click', function(event) {
  const isClickInsideActionMenu = document.querySelector('.action-menu').contains(event.target);

  const isClickOnActionButton = event.target.closest('.action-menu');

  if (!isClickInsideActionMenu && !isClickOnActionButton) {
      document.querySelectorAll('.action-menu').forEach(menu => {
          menu.style.display = 'none';
      });
  }
});

// create

document.getElementById('nameEmployee').addEventListener('input', function() {
  var selectedOption = document.querySelector('#employees option[value="' + this.value + '"]');
  if (selectedOption) {
    document.getElementById('employeeId').value = selectedOption.getAttribute('data-id');
  } else {
    document.getElementById('employeeId').value = '';
  }
});

// import giá trị employee_id khi người dùng chọn employee_name: 
const nameEmployeeInput = document.getElementById('nameEmployee');
const employeeCodeInput = document.getElementById('employeeCode');

nameEmployeeInput.addEventListener('input', function () {
  const datalist = document.getElementById('employees');
  const options = datalist.options;
  let selectedEmployeeId = '';

  for (let i = 0; i < options.length; i++) {
    if (options[i].value === nameEmployeeInput.value) {
      selectedEmployeeId = options[i].getAttribute('data-id');
      break;
    }
  }

  employeeCodeInput.value = selectedEmployeeId;
});


// show end hide noti delete

function confirmDelete(event, id) {
  event.preventDefault();
  document.getElementById('confirmDialog' + id).style.display = 'block';
}

function cancelDelete(id) {
  document.getElementById('confirmDialog' + id).style.display = 'none';
}

// show and hide note end contract
function confirmEnd(event, id) {
  event.preventDefault();
  document.getElementById('confirmEnd' + id).style.display = 'block';
}

function cancelEnd(id) {
  document.getElementById('confirmEnd' + id).style.display = 'none';
}


// show and hide noti renew
function confirmRenew(event, id) {
  event.preventDefault();
  document.getElementById('confirmRenew' + id).style.display = 'block';
}

function cancelRenew(id) {
  document.getElementById('confirmRenew' + id).style.display = 'none';
}


window.onclick = function (event) {
  var dialogs = document.getElementsByClassName('overlay-noti');
  for (var i = 0; i < dialogs.length; i++) {
    if (event.target == dialogs[i]) {
      dialogs[i].style.display = "none";
    }
  }
}

// error khi lập hợp đồng cho nhân viên mà nhân viên đó có hợp đồng còn hiệu lực
var alertContainer = document.querySelector('.alert-container');

if (alertContainer) {
  var closeButton = alertContainer.querySelector('.alert .bx');
  if (closeButton) {
    closeButton.addEventListener('click', function () {
      alertContainer.style.display = 'none';
    });
  }
}

// Xử lý lấy tên file khi upload để hiển thị ra giao diện
function updateFileName(input) {
  if (input.files.length > 0) {
    var fileName = input.files[0].name; 
    document.getElementById('fileName').value = fileName;
  } else {
    document.getElementById('fileName').value = "";
  }
}

// show noti-delete ở màn detail
function confirmDel(event, id) {
  event.preventDefault();
  document.getElementById('confirmDialog' + id).style.display = 'block';
}
// search contract
// const clearIcon = document.getElementById('clearSearch');
// clearIcon.addEventListener('click', function () {
//   const searchInput = document.getElementById('searchInput');
//   searchInput.value = '';
// });
// let searchInput = document.getElementById('searchInput');

// searchInput.addEventListener('input', function () {
//   let searchValue = this.value.trim();

//   if (searchValue === '') {
//     window.location.href = '/contracts';
//   }
// });