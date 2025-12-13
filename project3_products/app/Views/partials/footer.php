    </main>

    <footer>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center text-md-start mb-2 mb-md-0">
                    <i class="fas fa-boxes-stacked me-2"></i>Inventory Pro System
                </div>
                <div class="col-md-4 text-center mb-2 mb-md-0">
                    <a href="/api/products" target="_blank" class="text-white me-3" title="API Documentation">
                        <i class="fas fa-code"></i> API
                    </a>
                    <a href="javascript:void(0)" onclick="exportTableToCSV()" class="text-white" title="Export to CSV">
                        <i class="fas fa-download"></i> Export
                    </a>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <small>&copy; <?= date('Y') ?> - Assignment Project</small>
                </div>
            </div>
        </div>
    </footer>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="fas fa-check-circle me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="toastMessage">Operation completed successfully!</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function removeProduct(id) {
            if (confirm('Remove this product from inventory?')) {
                window.location.href = '/products/remove/' + id;
            }
        }
        
        function showToast(message, type = 'success') {
            const toast = document.getElementById('liveToast');
            const toastMessage = document.getElementById('toastMessage');
            const toastHeader = toast.querySelector('.toast-header');
            toastMessage.textContent = message;
            toastHeader.className = 'toast-header text-white bg-' + type;
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }
        
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('table');
            if (!table) return;
            const rows = table.getElementsByTagName('tr');
            let visibleCount = 0;
            
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                rows[i].style.display = found ? '' : 'none';
                if (found) visibleCount++;
            }
        }
        
        function filterByCategory() {
            const select = document.getElementById('categoryFilter');
            const filter = select.value.toLowerCase();
            const table = document.querySelector('table');
            if (!table) return;
            const rows = table.getElementsByTagName('tr');
            
            for (let i = 1; i < rows.length; i++) {
                const text = rows[i].textContent.toLowerCase();
                if (!filter || text.indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
        
        function exportTableToCSV() {
            const table = document.querySelector('table');
            if (!table) {
                showToast('No data to export', 'warning');
                return;
            }
            
            let csv = [];
            const rows = table.querySelectorAll('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const row = [];
                const cols = rows[i].querySelectorAll('td, th');
                
                for (let j = 0; j < cols.length - 1; j++) {
                    row.push('"' + cols[j].innerText.replace(/"/g, '""') + '"');
                }
                csv.push(row.join(','));
            }
            
            const csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
            const downloadLink = document.createElement('a');
            downloadLink.download = 'products_export_' + new Date().toISOString().slice(0,10) + '.csv';
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            
            showToast('Data exported successfully!', 'success');
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.animation = `fadeInUp 0.3s ease forwards ${index * 0.05}s`;
            });
        });
    </script>
</body>
</html>
