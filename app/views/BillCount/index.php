
<h2>Bill number: <?= $billNumber ?></h2>

<p class="col-auto"><a href="/bill_count/create/<?= $this->route['id'] ?>" class="btn btn-primary">Create</a></p>

<p>
  <a href="/bill_count/sum/<?= $this->route['id'] ?>" class="btn btn-secondary" id="get-sum">
    Get sum <span class="badge badge-light" id="sum"></span>
    <span class="spinner-border spinner-border-sm" style="display: none"></span>
  </a>
</p>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sum</th>
      <th scope="col">Quantity</th>
      <th scope="col">Name</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($billCount as $b) : ?>
      <tr>
        <th scope="row"><?= $b->id ?></th>
        <td><?= $b->sum ?></td>
        <td><?= $b->quantity ?></td>
        <td><?= $b->name ?></td>
        <td>
          <a href="/bill_count/delete/<?= $b->id ?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>