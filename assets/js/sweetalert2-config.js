$(document).ready(function() 
{
	const flashDataSuccess = $('.flashdata-success').data('flashdata');

	if (flashDataSuccess) {
		Swal.fire({
			title: 'Berhasil!',
			text: flashDataSuccess + '!',
			icon: 'success'
		});
	}

	const flashDataFailed = $('.flashdata-failed').data('flashdata');

	if (flashDataFailed) {
		Swal.fire({
			title: 'Gagal!',
			text: flashDataFailed + '!',
			icon: 'error'
		});
	}

	$('.btn-delete').on('click', function(e){
		e.preventDefault();

		const href = $(this).attr('href');
		const nama 	= $(this).data('nama');

		Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Ingin menghapus data " + nama + '!',
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