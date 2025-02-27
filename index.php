<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP MySQL Ajax CRUD with Bootstrap 5 and Datatables Library</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Font Awesome  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatables CSS  -->
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
  <!-- CSS  -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <nav class="navbar justify-content-center fs-3 mb-3" style="background-color:#00ff5573;">PHP Ajax CRUD Application</nav>

  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div class="text-body-secondary">
        <span class="h5">All Users</span>
        <br>
        Manage all your existing users or add a new on
      </div>
      <!-- Button to trigger Add user offcanvas -->
      <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
        <i class="fa-solid fa-user-plus fa-xs"></i>
        Add new user
      </button>
    </div>
    <table class="table table-bordered table-striped table-hover align-middle" id="myTable" style="width:100%;">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Image</th>
          <th>Email</th>
          <th>Country</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <!-- Add user offcanvas  -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" style="width:600px;">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add new user</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form method="POST" id="insertForm">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="Nikola">
          </div>
          <div class="col">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Tesla">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="name@example.com">
        </div>
        <div class="row mb-3">
          <label class="form-label">Upload Image</label>
          <div class="col-2">
            <img class="preview_img" src="images/default_profile.jpg">
          </div>
          <div class="col-10">
            <div class="file-upload text-secondary">
              <input type="file" class="image" name="image" accept="image/*">
              <span class="fs-4 fw-2">Choose file...</span>
              <span>or drag and drop file here</span>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Country</label>
          <select name="country" class="form-control">
            <option value="Afghanistan">Afghanistan</option>
            <option value="Åland Islands">Åland Islands</option>
            <option value="Albania">Albania</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
            <option value="Panama">Panama</option>
            <option value="Zimbabwe">Zimbabwe</option>
          </select>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Gender:</label>
          &nbsp;&nbsp;
          <input type="radio" class="form-check-input" name="gender" value="male">
          <label class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" value="female">
          <label class="form-input-label">Female</label>
        </div>
        <div>
          <button type="submit" class="btn btn-primary me-1" id="insertBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </form>
    </div>
  </div>




  <!-- Edit user offcanvas  -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" style="width:600px;">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit user data</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form method="POST" id="editForm">
        <input type="hidden" name="id" id="id">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="kuldep">
          </div>
          <div class="col">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="dubey">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="name@example.com">
        </div>
        <div class="row mb-3">
          <label class="form-label">Upload Image</label>
          <div class="col-2">
            <img class="preview_img" src="images/default_profile.jpg">
          </div>
          <div class="col-10">
            <div class="file-upload text-secondary">
              <input type="file" class="image" name="image" accept="image/*">
              <input type="hidden" name="image_old" id="image_old">
              <span class="fs-4 fw-2">Choose file...</span>
              <span>or drag and drop file here</span>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Country</label>
          <select name="country" class="form-control">
            <option value="Afghanistan">Afghanistan</option>
            <option value="Åland Islands">Åland Islands</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
          
            <option value="Yemen">Yemen</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
          </select>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Gender:</label>
          &nbsp;&nbsp;
          <input type="radio" class="form-check-input" name="gender" value="male">
          <label class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" value="female">
          <label class="form-input-label">Female</label>
        </div>
        <div>
          <button type="submit" class="btn btn-primary me-1" id="editBtn">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </form>
    </div>
  </div>



  <!-- Toast container  -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <!-- Success toast  -->
    <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Success!</strong>
          <span id="successMsg"></span>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
    <!-- Error toast  -->
    <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Error!</strong>
          <span id="errorMsg"></span>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>


  <!-- Bootstrap  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Datatables  -->
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
  <!-- JS  -->
  <script src="script.js"></script>
</body>

</html>