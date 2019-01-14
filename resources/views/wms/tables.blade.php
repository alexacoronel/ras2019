@extends('layouts.WMS')
@section('content')
<style>
.center {
  margin: auto;
  position: relative;
  text-align: center;
  top: 50%;
  width: 20%;
}
</style>

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{route('wms.summary')}}">Weather Monitoring</a>
    </li>
    <li class="breadcrumb-item active">Tables</li>
  </ol>

	<div class="card mb-3">
			<div class="card-header">
			  <i class="fa fa-table"></i> Data Tables</div>
			<div class="card-body">
        <div class="center">
            <!-- {/!/! $sensor_data->links('vendor.pagination.bootstrap-4') /!/!/} -->
        </div>
			  <div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				  <thead>
					<tr>
					  <th>Time</th>
					  <th>Sensor</th>
					  <th>Parameter</th>
					  <th>Value</th>
					</tr>
				  </thead>

				  <tfoot>
					<tr>
            <th>Time</th>
            <th>Sensor</th>
            <th>Parameter</th>
            <th>Value</th>
					</tr>
				  </tfoot>

				  <tbody>
				  @foreach($sensor_data as $data)
					<tr>
					  <td>{{ $data->c_time }}</td>
					  <td>{{ $data->c_sensor }}</td>
					  <td>{{ $data->c_sensed_parameter }}</td>
					  <td>{{ $data->c_value }}</td>
					</tr>
				  @endforeach
				  </tbody>
				</table>
			  </div>

      <div class="center">
          <!-- {/!/! $sensor_data->links('vendor.pagination.bootstrap-4') /!/!/} -->
      </div>

			</div>
			<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
		  </div>
@endsection
