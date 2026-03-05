@extends('admin.layouts.app')

@section('content')
<div class="container py-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Commandes</h4>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Total (FCFA)</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th class="text-end" style="width:240px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td class="fw-semibold">{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>{{ $order->customer_email ?? '—' }}</td>
                            <td>{{ number_format($order->total, 2, ',', ' ') }}</td>
                            <td>
                                @php
                                    $status = $order->status;
                                    $label = match($status) {
                                        'delivered' => 'Livré',
                                        'cancelled' => 'Annulé',
                                        'shipped' => 'En cours',
                                        'pending' => 'En attente',
                                        'confirmed' => 'Confirmée',
                                        default => $status,
                                    };
                                    $class = match($status) {
                                        'delivered' => 'bg-success-subtle text-success',
                                        'cancelled' => 'bg-danger-subtle text-danger',
                                        'shipped' => 'bg-warning-subtle text-warning',
                                        'pending' => 'bg-info-subtle text-info',
                                        'confirmed' => 'bg-primary-subtle text-primary',
                                        default => 'bg-secondary-subtle text-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $class }}">{{ $label }}</span>
                            </td>
                            <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="en_cours">
                                    <button type="submit" class="btn btn-sm btn-outline-warning">En cours</button>
                                </form>
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="livre">
                                    <button type="submit" class="btn btn-sm btn-outline-success">Livré</button>
                                </form>
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Annuler cette commande ?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="annule">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Annulé</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-4">Aucune commande trouvée.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @php($isPaginator = $orders instanceof \Illuminate\Pagination\AbstractPaginator)
        @if ($isPaginator && $orders->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $orders->onEachSide(1)->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
