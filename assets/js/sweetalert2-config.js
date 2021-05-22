$(document).ready(function() {
	$('.btn-delete').on('click', function(e){
		e.preventDefault();

		const href = $(this).attr('href');
		const nama 	= $(this).data('nama');

		Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Ingin menghapus data " + nama,
		  icon: 'warning',
		  showCancelButton: true,
		  cancelButtonColor: '#3085d6',
		  confirmButtonColor: '#d33',
		  confirmButtonText: 'Hapus Data!'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = href;
		  }
		});
	});
});