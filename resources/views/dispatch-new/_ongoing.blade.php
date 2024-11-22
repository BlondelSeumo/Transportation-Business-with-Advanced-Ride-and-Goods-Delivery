<style>
.btn{
  font-size:12px;
}
</style>
<table class="table caption-top tb">
    <thead>
      <tr>
        <th scope="col">Request No</th>
        <th scope="col">Date</th>
        <th scope="col">Pickup Location</th>
        <th scope="col">Drop Location</th>
        <th scope="col">Trip Status</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody id="append-rows">
    @forelse ($results as $key => $result)
    <tr class="ongoing" id="row_{{$result->id}}">
        <td scope="row">{{ $result->request_number }}</td>
        <td style="width:160px">{{ $result->converted_created_at }}</td>
        <td>{{ $result->getPickAddressAttribute() ?? '---------' }}</td>
        <td>{{ $result->getDropAddressAttribute() ?? '---------' }}</td>
        <?php 
        if($result->driver_id){
          $status = '<button class="btn btn-success"> assigned </button>';
          if($result->is_driver_started){$status = '<button class="btn btn-warning"> Driver on the way </button>';}
          if($result->is_driver_arrived){$status = '<button class="btn btn-success"> Driver arrived </button>';}
          if($result->is_trip_start){$status = '<button class="btn btn-warning"> On the ride </button>';}
        }else{
          $status='<button class="btn btn-warning"> Searching </button>';
        }
        ?>
        <td id="td_{{$result->request_number}}">{!! $status !!}</td>
        <td>
          <a href="{{ url('/').'/dispatch/detailed-view/'.$result->id }}" class="btn btn-primary" type="button">
         View</a>
        </td>
      </tr>
    @empty
    <tr class="no-data-found" id="row"><td colspan="6" style = " text-align: center; justify-content:center;">No Requests Yet</td></tr>
    @endforelse
    </tbody>
</table>
<div class="intro-y g-col-12 d-flex flex-wrap flex-sm-row flex-sm-nowrap align-items-center">
    <nav class="w-full w-sm-auto me-sm-auto">
        <ul class="pagination">
            {{ $results->links('pagination::bootstrap-4') }}
        </ul>
    </nav>
</div>

