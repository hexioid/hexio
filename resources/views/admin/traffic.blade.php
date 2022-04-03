@extends("admin.dashboard_template")


@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Traffic User</h3>
                <a href="{{route('admin.export-traffics')}}" class=" mx-1 float-right btn btn-success">
                  Export
                </a>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Traffic Link</th>
                        <th>Traffic Save Contact</th>
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
      "ajax": "{{route('admin.get_traffics')}}",
    });
</script>
@endsection