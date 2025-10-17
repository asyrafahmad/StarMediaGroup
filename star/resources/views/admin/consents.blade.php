@extends('layouts.admin')

@section('title','Admin - Consents')

@section('content')
  <h2>Consent Records</h2><br>

  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th>#</th>
        <th>GUID</th>
        <th>Accepted At</th>
        <th>Declined At</th>
        <th>Version</th>
        <th>IP</th>
        <th>User Agent</th>
      </tr>
    </thead>
    <tbody>
      {{-- @foreach($consents as $c)
        <tr>
          <td>{{ $c->id }}</td>
          <td>{{ $c->guid }}</td>
          <td>{{ $c->accepted_at }}</td>
          <td>{{ $c->declined_at }}</td>
          <td>{{ $c->version }}</td>
          <td>{{ $c->ip }}</td>
          <td style="max-width:300px;word-break:break-word;">{{ $c->user_agent }}</td>
        </tr>
      @endforeach --}}
    </tbody>
  </table>

  <div style="margin-top:1rem;">
    {{-- {{ $consents->links() }} --}}
  </div>
@endsection
