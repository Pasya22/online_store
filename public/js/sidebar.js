document.addEventListener('DOMContentLoaded', function() {
    let isSidebarOpen = false;
    let activeItem = '';

    function toggleSidebar() {
        isSidebarOpen = !isSidebarOpen;
        const navSamping = document.getElementById('navSamping');
        const chevronIcon = document.getElementById('chevronIcon');
        if (isSidebarOpen) {
            navSamping.classList.add('open');
            chevronIcon.classList.add('open');
        } else {
            navSamping.classList.remove('open');
            chevronIcon.classList.remove('open');
        }
    }

    function handleClick(item) {
        activeItem = item;
        // Highlight active item
        document.querySelectorAll('.navbar').forEach((link) => {
            link.classList.remove('active');
        });
        document.getElementById(`${item}Link`).classList.add('active');
        // Update label
        document.getElementById('dashboardLabel').innerHTML = item === 'dashboard' ? 'Dashboard' : 'Pembayaran';
        document.getElementById('pembayaranLabel').innerHTML = item === 'pembayaran' ? 'Pembayaran' : 'Data Produk';
        document.getElementById('dataprodukLabel').innerHTML = item === 'dataproduk' ? 'Data Produk' : 'Data Member';
        // More updates for other menu items
    }
});
