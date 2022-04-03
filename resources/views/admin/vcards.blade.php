@extends("admin.dashboard_template")


@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Vcard</h3>
                <button type="button" class="float-right btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                  Create Vcard
                </button>
                <a href="{{route('admin.export-vcards')}}" class=" mx-1 float-right btn btn-success">
                  Export
                </a>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Business</th>
                        <th>Phone 1</th>
                        <th>Phone 2</th>
                        <th>Phone 3</th>
                        <th>Address</th>
                        <th>Site 1</th>
                        <th>Site 2</th>
                        <th>Site 3</th>
                        <th>Total Download</th>
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
            <h5 class="modal-title" id="modalEditLabel">Detail Vcard</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.edit_vcard')}}" method="POST">
              @csrf
              <input type="hidden"  id="editId" name="id">
              <div class="form-group">
                <label for="">Username</label>
                <input readonly id="editUsername" name="username" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Name</label>
                <input required id="editName" name="name" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Business</label>
                <input id="editBusiness" name="business" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone 1</label>
                <input required id="editPhone1" name="phone_1" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone 2</label>
                <input id="editPhone2" name="phone_2" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone 3</label>
                <input id="editPhone3" name="phone_3" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Address</label>
                <input id="editAddress" name="address" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Site 1</label>
                <input id="editSite1" name="site_1" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Site 2</label>
                <input id="editSite2" name="site_2" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Site 3</label>
                <input id="editSite3" name="site_3" type="text" class="form-control">
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
            <h5 class="modal-title" id="modalCreateLabel">Create Vcard</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('admin.create_vcard')}}" method="POST">
              @csrf
              
              <label for="">User</label>
              <select name="user_id" class="custom-select" required>
                <option value="">Select user</option>
                @foreach($customers as $data)
                  <option value="{{$data->id}}">{{$data->name}}</option>
                @endforeach
              </select>
              <div class="form-group">
                <label for="">Name</label>
                <input required id="editName" name="name" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Business</label>
                <input id="editBusiness" name="business" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone 1</label>
                <input required id="editPhone1" name="phone_1" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone 2</label>
                <input id="editPhone2" name="phone_2" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Phone 3</label>
                <input id="editPhone3" name="phone_3" type="number" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Address</label>
                <input id="editAddress" name="address" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Site 1</label>
                <input id="editSite1" name="site_1" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Site 2</label>
                <input id="editSite2" name="site_2" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Site 3</label>
                <input id="editSite3" name="site_3" type="text" class="form-control">
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

    var table = $('#example2').DataTable({
      "paging": true,
      "scrollX": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
      "processing": true,
      "serverSide": true,
      "ajax": "{{route('admin.get_vcards')}}",
      "fixedColumns": true,
      "columnDefs": [
            { width: 120, targets: '_all' },
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                  return `
                    <div class="row mx-0">
                      <button onclick="openEditModal('`+row+`')" class="btn btn-warning btn-sm mr-2"><i class="fa-solid fa-pen-to-square"></i></button>
                      <button onclick="deleteItem(`+row[0]+`)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                    </div>`;
                },
                "targets": -1
            },
        ],
    });

    
    table.columns.adjust().draw();


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
          window.location = "vcard/"+id+"/delete";
        }
      })
    }

    function openEditModal(row){
      const data = row.split(",");

      $("#editId").val(data[0]);
      $("#editUsername").val(data[1]);
      $("#editName").val(data[2]);
      $("#editBusiness").val(data[3]);
      $("#editPhone1").val(data[4]);
      $("#editPhone2").val(data[5]);
      $("#editPhone3").val(data[6]);
      $("#editAddress").val(data[7]);
      $("#editSite1").val(data[8]);
      $("#editSite2").val(data[9]);
      $("#editSite3").val(data[10]);

      $('#modalEdit').modal('show');
    }
</script>
@endsection