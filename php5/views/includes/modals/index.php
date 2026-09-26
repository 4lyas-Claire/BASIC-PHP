<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Faculty Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="frmEdit">
            <div class="card">
                <div class="card-header">
                    Faculty Information
                </div>

                <div class="card-body">
            
                    <div class="mb-3 mt-3">
                        <label for="faculty_fname" class="form-label">First Name:</label>
                        <input type="hidden" id="faculty_id" name="id">
                        <input type="text" class="form-control" id="faculty_fname" placeholder="Enter First Name" name="fname" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="faculty_mname" class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" id="faculty_mname" placeholder="Enter Middle Name" name="mname" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="faculty_lname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="faculty_lname" placeholder="Enter Last Name" name="lname" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="faculty_age" class="form-label">Age:</label>
                        <input type="number" class="form-control" id="faculty_age" placeholder="Enter Age" name="age" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="faculty_gender" class="form-label">Gender:</label>
                        <select class="form-select" name="gender" id="faculty_gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="faculty_address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="faculty_address" placeholder="Enter Address" name="address" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="faculty_position" class="form-label">Position:</label>
                        <input type="text" class="form-control" id="faculty_position" placeholder="Enter Position" name="position" required>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="faculty_salary" class="form-label">Salary:</label>
                        <input type="number" step="0.01" class="form-control" id="faculty_salary" placeholder="Enter Salary" name="salary" required>
                    </div>
                
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>