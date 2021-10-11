<h1 style="margin-left: 20px;">Create a new student</h1>
<form style="margin: 20px;" action="" method="post">
  <div class="mb-3">
    <label  class="form-label">Fullname</label>
    <input type="text" name="fullname"class="form-control" required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Phone Number</label>
    <input type="number" name="number" class="form-control" required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label  class="form-label">Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="passwordConfirm" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>