
<p><a href="/bill/create" class="btn btn-primary">Craete</a></p>

<form  class="form-inline" action="/bill/index" method="post">

  <div class="form-group mx-sm-3 mb-3">
    <label for="status" class="mr-1">Status</label>
    <select class="form-control" name="status" id="status" required>
      <option value="0" >Not paid</option>
      <option value="1" >Paid</option>
    </select>
  </div>

  <div class="form-group mb-3">
    <label for="status" class="mr-1">Date</label>
    <input type="date" class="form-control" name="date" id="date" placeholder="Date" required>
  </div>

  <button type="submit" class="btn btn-info mb-3 ml-2">Filter</button>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Number</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
      <th scope="col">Discount</th>
      <th scope="col">Account composition</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	
  	<?php foreach ($bills as $key => $bill) : ?>
      <tr>
        <th scope="row"><?= $bill->id ?></th>
        <td><?= $bill->number ?></td>
        <td><?= $bill->status == 1 ? 'Paid' : 'Not paid' ?></td>
        <td><?= $bill->date ?></td>
        <td><?= $bill->discount ?>%</td>
        <td><?= $bill->bills_count ?></td>
        <td>
          <a href="/bill_count/index/<?= $bill->id ?>" class="btn btn-info btn-sm">Bills count</a>
          <a href="/bill/edit/<?= $bill->id ?>" class="btn btn-success btn-sm">Edit</a>
          <a href="/bill/delete/<?= $bill->id ?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
	  <?php endforeach ?>

  </tbody>
</table>