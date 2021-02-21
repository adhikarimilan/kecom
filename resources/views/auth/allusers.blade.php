@extends('layouts.app')
@section('content')
<script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        </script>
        @include('inc.messages')
        <div class="container-fluid">
        
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">View all Products</h1>
                {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> --}}
        
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
                  </div>
                  <div class="card-body">
                      @if(isset($users) && count($users))
                    <div class="table-responsive">
                      <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Email Verified</th>
                            <th>Joined On</th>
                            
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Email Verified</th>
                            <th>Joined On</th>
                            
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $user)
                          <tr>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->email_verified_at}}</td>
                          <td>{{$user->created_at}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    @endif
                  </div>
                </div>
        
              </div>
@endsection