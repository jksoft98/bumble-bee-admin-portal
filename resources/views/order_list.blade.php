<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Search Code</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Installment Plan</th>
                    <th>Total(LKR)</th>
                    @if(session()->get('user_role') != 2)
                    <th>Vendor</th>
                    @endif
                    <th>Created Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $data)
                      <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->search_code}}</td>
                        <td>{{$data->customer->full_name}}</td>
                        <td>{{$data->customer->phone}}</td>
                        <td>{{$data->customer->address}}</td>
                        <td>{{$data->installment_plan->plan}}</td>
                        <td>{{number_format($data->total_amount,2)}}</td> 
                        @if(session()->get('user_role') != 2)
                        <td>{{$data->vendor->business_name}} - ({{$data->vendor->phone}})</td>
                        @endif
                        <td>{{date( "Y-m-d / h:i:A", strtotime($data->created_date))}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
