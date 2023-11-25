<!-- Modal -->
<div class="modal fade" id="editEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Employee's Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="employeeForm" method="POST" action="{{ route('employee.table.update') }}" class="editEmp">
                @csrf
                <input type="text" id="emp_id" name="id" hidden>
                <h6>Employee's Information</h6>
                <div class="row border p-2">
                    
                    <div class="col-sm-4 mb-3">
                        <label for="employeeFirstName" class="form-label">First Name</label>
                        <input type="text" name="fName" class="form-control" id="employeeFirstNameE" required>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="employeeMiddleName" class="form-label">Middle Name</label>
                        <input type="text" name="mName" class="form-control" id="employeeMiddleNameE">
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="employeeLastName" class="form-label">Last Name</label>
                        <input type="text" name="lName" class="form-control" id="employeeLastNameE" required>
                    </div>
                    
                </div>

                <div class="row border p-2 mt-2">
                    
                    <div class="col-sm-4 mb-3">
                        <label for="employeeBirthDate" class="form-label">BirthDate</label>
                        <input type="date" name="bdate" class="form-control" id="employeeBirthDateE" required>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="employeeGender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="employeeGenderE" aria-label="Gender">
                            <option selected>Select your gender status</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            {{-- <option value="3">Three</option> --}}
                        </select>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="employeeAddress" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="employeeAddressE" required>
                    </div>
                    
                </div>

                <div class="row border p-2 mt-2">
                    
                    <div class="col-sm-4 mb-3">
                        <label for="employeeContact" class="form-label">Contact Number</label>
                        <input type="text" name="contact" class="form-control" id="employeeContactE" required>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="employeeHired" class="form-label">Date Hired</label>
                        <input type="date" name="datehired" class="form-control" id="employeeHiredE" required>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <label for="employeeHired" class="form-label">Employee Status</label>
                        <select class="form-select" name="status" id="employeeStatusE" aria-label="Default select example">
                            <option value="1">Employed</option>
                            <option value="0">Resigned</option>
                            <option value="2">Training</option>
                        </select>
                    </div>
                    
                </div>
                <!-- Add more fields as needed -->

                <!-- Additional details for employee information can be added here -->

                <button type="submit" class="btn btn-dark mt-2 float-end">Update Employee</button>
                <button type="button" class="btn btn-danger mt-2 float-end remove-emp me-2">Remove Employee</button>
            </form>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button> --}}
        </div>
      </div>
    </div>
  </div>