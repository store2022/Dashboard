const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

// script.js
<<<<<<< Updated upstream

function toggleDropdown(event) {
    event.preventDefault(); // Prevent default action
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block'; // Toggle display
}

// Close dropdown if clicked outside
window.onclick = function(event) {
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (!event.target.matches('.dropdown-toggle') && dropdownMenu.style.display === 'block') {
        dropdownMenu.style.display = 'none'; // Close the dropdown
    }
};


=======
>>>>>>> Stashed changes

function toggleDropdown(event) {
    event.preventDefault(); // Prevent default action
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block'; // Toggle display
}

// Close dropdown if clicked outside
window.onclick = function(event) {
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (!event.target.matches('.dropdown-toggle') && dropdownMenu.style.display === 'block') {
        dropdownMenu.style.display = 'none'; // Close the dropdown
    }
};




const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

function showNegara() {
    // Hapus kelas active dari semua menu
    document.querySelectorAll('.side-menu li').forEach(item => {
        item.classList.remove('active');
    });

    // Tambahkan kelas active ke parent li dari menu Negara
    document.querySelector('a[href="index.php?page=negara"]').closest('li').classList.add('active');

    // Ambil konten negara
    fetch('negara/indexnegara.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('main-content').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('main-content').innerHTML = '<h1>Error loading content</h1>';
        });
}

function tambahNegara() {
    fetch('negara/tambah.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('main-content').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan!');
        });
}