<?php
function querryResult($connection, $query)
{
	$odbcexec = odbc_exec($connection, trim($query));
	$rArray = array();
	while ($rows = odbc_fetch_array($odbcexec)) {
		$rArray[] = $rows;
	}
	odbc_free_result($odbcexec);
	return $rArray;
}

function indostyle_date($tanggal, $display_day = false)
{
	$hari = array(
		1 =>    'Senin',
		'Selasa',
		'Rabu',
		'Kamis',
		'Jumat',
		'Sabtu',
		'Minggu'
	);

	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

	if ($display_day) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}
?>



<script>
	function scroll(timeslide) {
		// timeline = timeline - 2;
		timeslide = timeslide - 4;
		var putaran = 2;
		var jmlscroll = putaran * 2;
		var intv = 30;
		var jmlloop = timeslide * 1000 / jmlscroll / intv;
		var scrollHeight = $('#bodyscroll')[0].scrollHeight + 3 * $('#kepala')[0].scrollHeight - $(window).height() ? $('#bodyscroll')[0].scrollHeight + 3 * $('#kepala')[0].scrollHeight - $(window).height() : 250;
		var heightintv = scrollHeight / jmlloop;
		// window.alert($(window).height());
		// window.alert($('#kepala')[0].scrollHeight);
		// window.alert($('#bodyscroll')[0].scrollHeight);
		// window.alert(scrollHeight);
		var sumscroll = 0;
		var perscroll = 0;
		var autoscroll = setInterval(function() {
			$("#bodyscroll").animate({
				scrollTop: scrollHeight
			}, 5000).animate({
				scrollTop: -scrollHeight
			}, 5000);

			// document.getElementById("bodyscroll").scrollBy(0, heightintv);
			// sumscroll = sumscroll + 1;
			// if (sumscroll>=jmlloop) {
			//   perscroll = perscroll + 1;
			//   heightintv = -heightintv;
			//   sumscroll = 0;
			// }
			// if (perscroll>=jmlscroll) {
			//   clearInterval(autoscroll);
			// }
		}, intv);
	}
</script>