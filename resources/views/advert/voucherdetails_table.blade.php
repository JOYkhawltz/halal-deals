@csrf
@forelse($vouchers as $voucher)
@php
$user=App\User::where('id','=',$voucher->purchasing_user)->first();
@endphp
<tr>
    <td>{{$voucher->voucher_ID}}</td>
    <td>
        @if($voucher->redeem==='1')
        <span class="badge badge-success">redeem</span>
        @else
        <span class="badge badge-warning">Not redeem</span>
        @endif
    </td>
    <td>{{$user->first_name.' '.$user->last_name}}</td>                                    
    <td>
        @if($voucher->status==='0')
        <span class="badge badge-warning">Pending</span>
        @else
        <span class="badge badge-success">Active</span>
        @endif
    </td>
    <td>
        <a href="{{Route('advert-voucheredit-details',['id'=>($voucher->id)])}}" class="edit"><i class="icofont-ui-edit"></i></a>
    </td>
</tr>
@empty
<tr>
    <td colspan="10">No voucher redeemed.</td>
</tr>
@endforelse