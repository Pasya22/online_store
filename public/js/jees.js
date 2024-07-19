document.addEventListener('DOMContentLoaded', function() {
    let isSidebarOpen = false;

    function togglepropil() {
        isSidebarOpen = !isSidebarOpen;
        const cardPropil = document.getElementById('cardPropil');
        const caretIcon = document.getElementById('caretIcon');

        if (isSidebarOpen) {
            cardPropil.classList.add('open');
            caretIcon.classList.add('open');
        } else {
            cardPropil.classList.remove('open');
            caretIcon.classList.remove('open');
        }
    }

    function handleClickOutside(event) {
        const grubpropil = document.getElementById('grubpropil');
        if (!grubpropil.contains(event.target)) {
            isSidebarOpen = false;
            const cardPropil = document.getElementById('cardPropil');
            const caretIcon = document.getElementById('caretIcon');
            cardPropil.classList.remove('open');
            caretIcon.classList.remove('open');
        }
    }

    document.addEventListener("mousedown", handleClickOutside);
});



// sidebar
// document.addEventListener('DOMContentLoaded', function() {
//     let isSidebarOpen = false;
//     let activeItem = '';

//     function toggleSidebar() {
//         isSidebarOpen = !isSidebarOpen;
//         const navSamping = document.getElementById('navSamping');
//         const chevronIcon = document.getElementById('chevronIcon');
//         if (isSidebarOpen) {
//             navSamping.classList.add('open');
//             chevronIcon.classList.add('open');
//         } else {
//             navSamping.classList.remove('open');
//             chevronIcon.classList.remove('open');
//         }
//     }

//     function handleClick(item) {
//         activeItem = item;
//         // Highlight active item
//         document.querySelectorAll('.navbar').forEach((link) => {
//             link.classList.remove('active');
//         });
//         document.getElementById(`${item}Link`).classList.add('active');
//         // Update label
//         document.getElementById('dashboardLabel').innerHTML = item === 'dashboard' ? 'Dashboard' : 'Pembayaran';
//         document.getElementById('pembayaranLabel').innerHTML = item === 'pembayaran' ? 'Pembayaran' : 'Data Produk';
//         document.getElementById('dataprodukLabel').innerHTML = item === 'dataproduk' ? 'Data Produk' : 'Data Member';
//         // More updates for other menu items
//     }
// });



// ========= fungsi ganti data produk

function changeMode(mode) {
    if (mode === 'mode1') {
        document.getElementById('grubcard1').style.display = 'block';
        document.getElementById('grubcard2').style.display = 'none';
        document.getElementById('mode1').style.display = 'none';
        document.getElementById('mode2').style.display = 'block';
        document.querySelectorAll('.mode-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById('mode1').classList.add('active');
    } else {
        document.getElementById('grubcard1').style.display = 'none';
        document.getElementById('grubcard2').style.display = 'flex';
        document.getElementById('mode1').style.display = 'block';
        document.getElementById('mode2').style.display = 'none';
        document.querySelectorAll('.mode-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById('mode2').classList.add('active');
    }
}

// buka keranjang
// document.addEventListener('DOMContentLoaded', function() {
//     let isSidebarOpen = false;

//     function bukakeranjang() {
//         isSidebarOpen = !isSidebarOpen;
//         const sidebar = document.getElementById('keranjang');
//         const thumbtackIcon = document.getElementById('thumbtackIcon');
//         const isikeranjang = document.getElementById('isikeranjang');
//         const grubtotal = document.getElementById('grubtotal');

//         if (isSidebarOpen) {
//             sidebar.classList.add('open');
//             thumbtackIcon.classList.add('open');
//             isikeranjang.classList.add('open');
//             grubtotal.classList.add('open');
//         } else {
//             sidebar.classList.remove('open');
//             thumbtackIcon.classList.remove('open');
//             isikeranjang.classList.remove('open');
//             grubtotal.classList.remove('open');
//         }
//     }

//     window.bukakeranjang = bukakeranjang;
// });
