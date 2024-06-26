let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".show-sidebar");
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
})


document.addEventListener('DOMContentLoaded', function () {
    let rowsPerPage = getRowsPerPage(); 
    let currentPage = 1;
    let allRows = [];

    function getRowsPerPage() {
        
        return window.innerWidth <= 1024 ? 20 : 10; 
    }

    function setupPagination(data) {
        const pageCount = Math.ceil(data.length / rowsPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        for (let i = 1; i <= pageCount; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
            pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            pageItem.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                showTableData(data);
            });
            pagination.appendChild(pageItem);
        }
    }

    function showTableData(data) {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedData = data.slice(start, end);

        const tableBody = document.getElementById('dataTable');
        tableBody.innerHTML = '';
        paginatedData.forEach(row => {
            tableBody.appendChild(row);
        });

        setupPagination(data);
    }

    document.getElementById('searchInput').addEventListener('input', function (e) {
        const searchText = e.target.value.toLowerCase();
        const filteredRows = allRows.filter(row => {
            const cells = Array.from(row.cells);
            return cells.some(cell => cell.innerText.toLowerCase().includes(searchText));
        });

        currentPage = 1;
        showTableData(filteredRows);
    });

    allRows = Array.from(document.querySelectorAll('#dataTable tr'));
    showTableData(allRows);
    
    window.addEventListener('resize', function () {
        rowsPerPage = getRowsPerPage(); 
        showTableData(allRows); 
    });
});
