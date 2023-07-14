<div class="container mt-3">
	<div class="row">
		<div class="col-sm-12">
			<?php
				Flasher::Message();
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<h1>History</h1>
			<table class="table table-stripped">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col" width="200px">Time</th>
						<th scope="col" width="200px">Type</th>
						<th scope="col" width="200px">Debit</th>
						<th scope="col" width="200px">Credit</th>
						<th scope="col" width="200px">Balance</th>
					</tr>
				</thead>
				<tbody>
					<?php 
							$n=0;
						foreach ($data['balance'] as $balance): 
							$n = $n+1;
							?>
						<tr>
							<td><?= $n;?></td>
							<td>
								<?php echo $balance['date']?>
							</td>
							<td><?php echo $balance['type']?></td>
							<td><?php echo $balance['debit']?></td>
							<td><?php echo $balance['credit']?></td>
							<td><?php echo $balance['balance']?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>	
		</div>
	</div>
</div>