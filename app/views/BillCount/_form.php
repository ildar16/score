
<form method="post" action="/bill_count/store/<?= $this->route['id'] ?>" style="width: 100%">

  <div class="form-group">
    <label for="sum">Sum</label>
    <input type="number" class="form-control" name="sum" id="sum" placeholder="Sum" required>
  </div>

  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" required>
  </div>

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
  <a href="/bill/index" class="btn btn-info">Back</a>
</form>