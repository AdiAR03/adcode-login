const flashDataError = $('.flash-data-error').data('flashdata');

if (flashDataError) {
	let timerInterval
	Swal.fire({
	  type: 'error',
	  title: 'Oops...',
	  text	: '' + flashDataError,
	})
}


const flashData = $('.flash-data').data('flashdata');

if (flashData) {
	let timerInterval
	Swal.fire({
	  	title	: 'Selamat',
		text	: '' + flashData,
		type	: 'success',
		width	: 400,
	  	// padding	: '3em',
	 
	  timer: 1000,
	  onBeforeOpen: () => {
	    const content = Swal.getContent()
	    const $ = content.querySelector.bind(content)

	    Swal.showLoading()

	    function toggleButtons () {
	      stop.disabled = !Swal.isTimerRunning()
	      resume.disabled = Swal.isTimerRunning()
	    }

	    timerInterval = setInterval(() => {
	      Swal.getContent().querySelector('strong')
	        .textContent = (Swal.getTimerLeft() / 1000)
	          .toFixed(0)
	    }, 100)
	  },
	  onClose: () => {
	    clearInterval(timerInterval)
	  }
	})
}

const flashData2 = $('.flash-data2').data('flashdata');

if (flashData2) {
	let timerInterval
	Swal.fire({
	  	title	: 'Data Pengunjung Berhasil Disimpan',
		text	: '' + flashData2,
		type	: 'success',
		width	: 400,
	  	// padding	: '3em',
	 
	  timer: 3000,
	  onBeforeOpen: () => {
	    const content = Swal.getContent()
	    const $ = content.querySelector.bind(content)

	    Swal.showLoading()

	    function toggleButtons () {
	      stop.disabled = !Swal.isTimerRunning()
	      resume.disabled = Swal.isTimerRunning()
	    }

	    timerInterval = setInterval(() => {
	      Swal.getContent().querySelector('strong')
	        .textContent = (Swal.getTimerLeft() / 1000)
	          .toFixed(0)
	    }, 100)
	  },
	  onClose: () => {
	    clearInterval(timerInterval)
	  }
	})
}

$('.tombolhapus').on('click', function(e)
{
	e.preventDefault();
	const href = $(this).attr('href')
	Swal.fire({
	  title: 'Hapus',
	  text: "Yakin Hapus Data Ini ???",
	  type: 'warning',
	  width	: 400,
	  padding	: '3em',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yakin!'
	}).then((result) => {
	  if (result.value) {
	    document.location.href = href
	  }
	})

})

$('.readtombol').on('click', function(e)
{
	e.preventDefault();
	const href = $(this).attr('href')
	Swal.fire({
	  title: 'Ubah Akses',
	  text: "Yakin Ubah Hak Akses ???",
	  type: 'warning',
	  width	: 400,
	  padding	: '3em',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yakin!'
	}).then((result) => {
	  if (result.value) {
	    document.location.href = href
	  }
	})

})