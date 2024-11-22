@component('mail::message')
# Hi {{$data['driverName']}} ,


        Your {{ $data['documentName'] }} is going to expires {{ $data['docExpiryInDays'] != 0 ? 'in '. $data['docExpiryInDays']. ' days' : 'tomorrow' }} ({{ $data['documentExpiry'] }}).Upload your valid document.
 


Thanks,<br>
  {{ config('app.name') }}
@endcomponent
