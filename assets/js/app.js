$(document).ready(function () {
	// On Load (disable class pemesanan sama dengan true)
	$(".pemesanan").attr('disabled', true);
	// On choise
	$("form input:radio").change(function () {
		if ($(this).val() == "pembelian") {
			$(".pemesanan").attr('disabled', true); // (disable class pemesanan sama dengan true)
		} else {
			$(".pemesanan").attr('disabled', false); // (disable class pemesanan sama dengan false)
		}
	});
});
