
<form method="post" action="<?= $this->route['action'] == 'edit' ? '/bill/update/' . $this->route['id'] : '/bill/store/' ?>" style="width: 100%">
  <div class="form-group">
    <label for="number">Number</label>
    <input type="number" class="form-control" name="number" id="number" placeholder="Number" value="<?= $bill->number ?? '' ?>" required>
  </div>

  <div class="form-group">
    <label for="status">Status</label>
  	<select class="form-control" name="status" id="status" required>
  	  <option value="0" <?= isset($bill->status) && $bill->status == 0 ? 'selected' : '' ?>>Not paid</option>
  	  <option value="1" <?= isset($bill->status) && $bill->status == 1 ? 'selected' : '' ?>>Paid</option>
  	</select>
  </div>

  <div class="form-group">
    <label for="status">Date</label>
    <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?= $bill->date ?? '' ?>" required>
  </div>

  <div class="form-group">
    <label for="discount">Discount</label>
    <input type="number" class="form-control" name="discount" id="discount" placeholder="Discount" value="<?= $bill->discount ?? '' ?>" required>
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
  <a href="/bill/index" class="btn btn-info">Back</a>
</form>