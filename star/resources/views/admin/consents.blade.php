@extends('layouts.admin')

@section('title','Admin - Consents')

@section('content')
  <h2>Consent Records</h2><br>

  <div style="max-height:300px; overflow:auto; border:1px solid #ddd; border-radius:8px;">
  <table style="width:100%; border-collapse:collapse; font-size:12px; min-width:800px;">
    <thead style="position:sticky; top:0; background:#f8f8f8; z-index:1;">
      <tr>
        <th style="text-align:left; padding:6px; border-bottom:1px solid #ddd;">GUID</th>
        <th style="text-align:left; padding:6px; border-bottom:1px solid #ddd;">Accepted At</th>
        <th style="text-align:left; padding:6px; border-bottom:1px solid #ddd;">Declined At</th>
        <th style="text-align:left; padding:6px; border-bottom:1px solid #ddd;">Version</th>
        <th style="text-align:left; padding:6px; border-bottom:1px solid #ddd;">IP</th>
        <th style="text-align:left; padding:6px; border-bottom:1px solid #ddd;">User Agent</th>
      </tr>
    </thead>
    <tbody>
      @foreach($consents as $c)
        <tr>
          <td style="padding:6px; border-bottom:1px solid #eee;">{{ $c->guid }}</td>
          <td style="padding:6px; border-bottom:1px solid #eee;">{{ $c->accepted_at }}</td>
          <td style="padding:6px; border-bottom:1px solid #eee;">{{ $c->declined_at }}</td>
          <td style="padding:6px; border-bottom:1px solid #eee;">{{ $c->version }}</td>
          <td style="padding:6px; border-bottom:1px solid #eee;">{{ $c->ip_address }}</td>
          <td style="padding:6px; border-bottom:1px solid #eee; max-width:300px; word-break:break-word;">{{ $c->user_agent }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>


  <div style="margin-top:1rem;">
    {{-- {{ $consents->links() }} --}}
  </div>
@endsection
