@extends("admin.dashboard_template")


@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Customers</h3>
                <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                  Create Customers
                </button>
                <a href="{{route('admin.export-customers')}}" class=" mx-1 float-right btn btn-success">
                  Export
                </a>

                
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>


    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Detail User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.edit_customer')}}" method="POST">
              @csrf
              <input type="hidden"  id="editId" name="id">
              <div class="form-group">
                <label for="">Name</label>
                <input required id="editName" name="name" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Username</label>
                <input required id="editUsername" name="username" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input required id="editEmail" name="email" type="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input name="password" type="password" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone</label>
                <input required id="editPhone" name="telephone" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Address</label>
                <input name="address" id="editAddress" type="text" class="form-control">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

     <!-- Modal Create -->
     <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCreateLabel">Create Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.create_customer')}}" method="POST">
              @csrf
              <div class="form-group">
                <label for="">Name</label>
                <input required name="name" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Username</label>
                <input required name="username" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input required name="email" type="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input required name="password" type="password" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone</label>
                <input required name="telephone" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Address</label>
                <input name="address" type="text" class="form-control">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section("script")
<script>
    selectedArrayForEdit = [];

    $('#example2').DataTable({
      "paging": true,
      "scrollX": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ajax": "{{route('admin.get_customers')}}",
      "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                  console.log(data);
                  return `
                    <div class="row mx-0">
                      <button onclick="openEditModal('`+row+`')" class="btn btn-warning btn-sm mr-2"><i class="fa-solid fa-pen-to-square"></i></button>
                      <button onclick="deleteItem(`+row[0]+`)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                    </div>`;
                },
                "targets": -1
            },
        ]
    });


    function deleteItem(id){
      console.log(id);
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#262626',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "customer/"+id+"/delete";
        }
      })
    }

    function openEditModal(row){
      const data = row.split(",");

      $("#editId").val(data[0]);
      $("#editName").val(data[2]);
      $("#editUsername").val(data[1]);
      $("#editEmail").val(data[3]);
      $("#editPhone").val(data[4]);
      $("#editAddress").val(data[5]);

      $('#modalEdit').modal('show');
    }
</script>
@endsection