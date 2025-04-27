@extends('customer.layouts.layout')

@section('customer_layout')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto">
            <h3>Affiliate Program</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Your Referral Link</h5>
                    <button class="btn btn-primary btn-sm" onclick="copyToClipboard()">Copy Link</button>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="referralLink" value="{{ url('/register?ref=' . (auth()->user()->affiliate_code ?? '')) }}" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <div class="alert alert-info">
                        Share this link with your friends and earn rewards when they make purchases!
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Referral Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6 col-xl-4">
                            <div class="card card-body bg-light">
                                <h5>Total Referrals</h5>
                                <h3 class="mt-2 mb-0">{{ $stats->total_referrals ?? 0 }}</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="card card-body bg-light">
                                <h5>Active Customers</h5>
                                <h3 class="mt-2 mb-0">{{ $stats->active_customers ?? 0 }}</h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="card card-body bg-light">
                                <h5>Total Earnings</h5>
                                <h3 class="mt-2 mb-0">${{ number_format($stats->total_earnings ?? 0, 2) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Referrals</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReferrals ?? [] as $referral)
                            <tr>
                                <td>{{ $referral->created_at }}</td>
                                <td>{{ $referral->customer_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $referral->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($referral->status) }}
                                    </span>
                                </td>
                                <td>${{ number_format($referral->commission, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No referrals yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Program Benefits</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Earn 10% commission on all referred purchases
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Track referrals and earnings in real-time
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Monthly payments via your preferred method
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Access to exclusive promotional materials
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Next Payout</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span>Current Balance:</span>
                        <strong>${{ number_format($currentBalance ?? 0, 2) }}</strong>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span>Next Payout Date:</span>
                        <strong>{{ $nextPayoutDate ?? 'N/A' }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard() {
    var copyText = document.getElementById("referralLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Referral link copied to clipboard!");
}
</script>
@endpush
@endsection
