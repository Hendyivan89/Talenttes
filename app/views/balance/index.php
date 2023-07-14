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
			<button type="button" class="btn btn-primary btnTambahData" data-toggle="modal" data-target="#exampleModal" data-zurl="<?= BASEURL; ?>">
				Add Balance
			</button>
			<button type="button" class="btn btn-primary btnWithdraw" data-toggle="modal" data-target="#exampleModal1" data-zurl="<?= BASEURL; ?>">
				Withdraw Amount
			</button>

			<h1>Check Balance</h1>
			<table class="table table-stripped">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col" width="200px">Balance</th>
						<th scope="col" width="200px">Date</th>
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
								<?php echo $balance['amount']?>
							</td>
							<td><?php echo $balance['create_at']?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>	
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Balance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="<?= BASEURL; ?>/balance/savebalance" method="POST" enctype="multipart/form-data">
      		<input type="hidden" name="id" id="id">
					<div class="form-group">
	        	<label for="amount">Amount</label>
	        	<input type="text" name="amount" id="amount" class="form-control" placeholder="add amount" required="true">
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      	</form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Withdraw Amount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="<?= BASEURL; ?>/balance/withdrawbalance" method="POST" enctype="multipart/form-data">
      		<input type="hidden" name="id" id="id" value="<?php echo $data['balance'][0]['id'] ?>">
					<div class="form-group">
	        	<label for="amount">Amount</label>
	        	<input type="text" name="amount" id="amount" class="form-control" placeholder="add amount" required="true">
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      	</form>
    </div>
  </div>
</div>