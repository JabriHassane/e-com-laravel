<!-- Upload CSV Button -->
<button class="btn btn-success mr-2 ml-2 rounded" data-toggle="modal" data-target="#uploadCsvModal">
    <i class="icon-paper-and-pencil"></i> Import CSV
</button>

<div class="modal fade" id="uploadCsvModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="{{ route('categories.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Upload Categories via CSV</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="csv_file">Choose CSV file</label>
          <h6>CSV format :</h6>
          <p><b>name,description,is_active</b></br>
          Books,All books,1</br>
          Music,All music,1</p>

          <input type="file" name="csv_file" id="csv_file" accept=".csv,.xls,.xlsx" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Import</button>
      </div>
    </form>
  </div>
</div>


<!-- Delete CSV Button -->
<button class="btn btn-danger rounded" data-toggle="modal" data-target="#deleteCsvModal">
    <i class="icon-list"></i> Delete via CSV
</button>

<div class="modal fade" id="deleteCsvModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="{{ route('categories.deleteCsv') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Delete Categories via CSV</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="delete_csv_file">Choose CSV file</label>
          <h6>CSV format :</h6>
          <p><b>id</b> <b>OR</b> <b>name</b></br>
          1 <b>OR</b> Books</br>
          2 <b>OR</b> Music</p>
          
          <input type="file" name="csv_file" id="delete_csv_file" accept=".csv,.xls,.xlsx" class="form-control" required>
        </div>
        <p class="text-danger mt-2">⚠ Categories matching the IDs or names in this file will be deleted.</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete Categories</button>
      </div>
    </form>
  </div>
</div>
