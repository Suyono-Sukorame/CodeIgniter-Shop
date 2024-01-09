<?php 
	if ($status == 'waiting') {
		$badge_status	= 'badge text-bg-primary';
		$status			= 'Menunggu Pembayaran';
	}

	if ($status == 'paid') {
		$badge_status	= 'badge text-bg-secondary';
		$status			= 'Dibayar';
	}

	if ($status == 'delivered') {
		$badge_status	= 'badge text-bg-success';
		$status			= 'Dikirim';
	}

	if ($status == 'cancel') {
		$badge_status	= 'badge text-bg-danger';
		$status			= 'Dibatalkan';
	}
?>

<?php if ($status) : ?>
<span class="badge badge-pill <?= $badge_status ?>"><?= $status ?></span>
<?php endif ?>