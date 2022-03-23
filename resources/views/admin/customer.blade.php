@extends("admin.dashboard_template")


@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar User</h3>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Business</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Site 1</th>
                        <th>Site 2</th>
                        <th>Site 3</th>
                        <th>Total Kunjungan</th>
                        <th>Terakhir Update</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section("script")
<script>
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "processing": true,
        "serverSide": true,
        "ajax": "{{route('admin.get_customers')}}"
    });
</script>
@endsection