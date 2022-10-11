<!doctype html>
<html lang="en">
  <body>
    <main class="mt-2 container">
      <div class="card">
        <div class="card-header py-3 fw-bold fs-5">
          Add Image Details
        </div>
        <form id="upload-picture-form" class="p-3">
          <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Select Storage Methods :</legend>
            <div class="col-sm-10 d-flex">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="gridRadios1" value="imgur" required>
                <label class="form-check-label" for="gridRadios1">imgur</label>
              </div>
              <div class="form-check ms-3">
                <input class="form-check-input" type="radio" name="type" id="gridRadios2" value="file system" required>
                <label class="form-check-label" for="gridRadios2">File system</label>
              </div>
            </div>
          </fieldset>
          <div class="row mb-3">
            <label for="inputfile" class="col-sm-2 col-form-label">Select image file : </label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="image" accept="image/png, image/jpeg, image/jpg" id="inputfile" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputfilecolor" class="col-sm-2 col-form-label">Select image color : </label>
            <div class="col-sm-10">
              <input id="inputfilecolor" type="text" class="form-control" name="imageColor" value="" required />
            </div>
          </div>
          <div class="row mb-3">
            <label for="shortDescription" class="col-sm-2 col-form-label">Short Description : </label>
            <div class="col-sm-10">
              <textarea class="form-control" id="shortDescription" name="description" rows="3" maxlength="200" required></textarea>
            </div>
          </div>
          <input type="hidden" name="cookie" value="<?php echo $_COOKIE['user']; ?>">
          <div class="row pe-3 float-end ">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
        <div class="row p-3">
          <div class="alert alert-danger d-none" role="alert"></div>
          <div class="alert alert-success d-none" role="alert"></div>
        </div>
      </div>
    </main>
    <script>
      $(function () {
        $('#inputfilecolor').colorpicker();
      });
    </script>
  </body>
</html>