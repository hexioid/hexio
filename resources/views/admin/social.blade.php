@extends("admin.dashboard_template")


@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Social Media Customers</h3>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        @foreach($data as $link_type)
                          <th>{{$link_type->type}}</th>
                        @endforeach
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
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "ajax": "{{route('admin.get_social')}}",
      "columnDefs": [
            { width: 100, targets: '_all' }
        ],
        "fixedColumns": true
    });

    table.columns.adjust().draw();

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